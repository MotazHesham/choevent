<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\City;
use App\Models\Category;
use Auth;


class EventsController extends Controller
{
    public function index(Request $request){

        if($request->organizer_id){

            $events=Event::has('tickets')->where('user_id',$request->organizer_id)->where('publish',1)->paginate(8);
        }elseif($request->category_id){

            $events=Event::has('tickets')->whereHas('category',function($q)use($request){
                return $q->where('id',$request->category_id);
            })->where('publish',1)->paginate(8);
        }else{
            $events=Event::has('tickets')->has('user')->where('publish',1)->paginate(8);
        }
        
        return view('website.events.index',compact('events'));
    }

    public function search(Request $request,Event $event){
        $event=$event->newQuery();
        if($request->name){
            $event->has('tickets')->where('name','like',"%{$request->name}%");
        }
        if($request->category_id){
            $event->has('tickets')->whereHas('category',function($q)use($request){
                return $q->where('id',$request->category_id);
            });
        }
        if($request->city_id){
            $event->has('tickets')->where('city_id',$request->city_id);

        }
        if($request->date){
            $event->has('tickets')->whereDate('start_at','<',$request->date)
            ->whereDate('end_at','>',$request->date);
        }
        $events=$event->where('publish',1)->paginate(8);
        return view('website.events.index',compact('events'));
        
    }

    public function create(){
       
        $cities=City::all()->pluck('name', 'id');
        $activities=Category::where('type','activity')->pluck('name', 'id');
        return view('website.events.create',compact('cities','activities'));
    }

    public function store (StoreEventRequest $request){
        $event = Event::create($request->all());
       

        if ($request->featured_image) {
            $event->addMedia(storage_path('tmp/uploads/' . $request->featured_image))->toMediaCollection('featured_image');
        }
        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $event->id]);
        }

        return redirect()->route('website.profile')->with('msg','تم إضافة الفعالية بنجاح..ستقوم إدارة المنصة بمراجعتها ونشرها فى أقرب وقت');
   
    }

    public function show($id){
     
        $event=Event::where('id',$id)->where('publish',1)->first();
        
        return view('website.events.show',compact('event'));
    }
    public function getOrganizerEvents(){
        
        $user=Auth::user();
        if($user->group=='sponsor'){
            $events=Event::where('publish',1)
                ->whereHas('sponsoringOrders',function($q)use($user){
                    return $q->where('sponsor_id',$user->id)->orWhere('sponsor_id',null);
                })->get();
        }elseif($user->group=='provider'){
            $events=Event::where('publish',1)
                ->whereHas('serviceOrders',function($q)use($user){
                    return $q->where('service_provider_id',$user->id)->orWhere('service_provider_id',null);
                })->get();
        }else{
            $events=$user->events()->where('publish',1)->get();
        }
        
        return view('website.events.organizer_events',compact('events','user'));

    }

    
   
}
