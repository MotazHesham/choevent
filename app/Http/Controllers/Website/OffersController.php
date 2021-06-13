<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Offer;
use App\Models\Event;
use App\Models\Order;
use Auth;

class OffersController extends Controller
{
    public function index(Request $request){
    
        $user=Auth::user();
        $type=$request->type??'sponsoring';
        if($user->group=='organizer'){
           $offers=Offer::where('publish','<>',0)->where('order_id',$request->order_id)->get();
        }else{
            $offers=$user->{$type."Offers"};
            
        }
        
        return view('website.offers.'.$type.'.index', compact('offers','user'));
    }

    public function create(Request $request){
        $user=Auth::user();
        $type=$request->type??'sponsoring';
        $order=Order::findorfail($request->order_id);
        $event=Event::findorfail($request->event_id);
        return view('website.offers.'.$type.'.create', compact('order','user','event'));
  
    }
    public function store(Request $request)
    {
        $type=$request->type;
        $input=$request->input();
        if($type=="service"){
            $input['service_provider_id']=Auth::id();
        }else{
            $input['sponsor_id']=Auth::id();
        }
        $offer = Offer::create($input);
       
        return redirect()->route('website.offers.index',['type'=>$type]);
    }
    public function show($id){
        $offer=Offer::find($id);
        $user=Auth::user();
        $type=$offer->order->type;
     return view('website.offers.'.$type.'.show',compact('offer','user'));

    }

    public function confirm($id){
        $offer=Offer::find($id);
        $type=$offer->order->type;
        $order=$offer->order;
        if($type=="service"){
            $order->service_provider_id=$offer->service_provider_id;
        }else{
           $order->sponsor_id=$offer->sponsor_id;
        }
        $order->publish=2;
        $order->save();
        $offer->publish=2;
        $offer->save();

        return redirect()->back();
    }

}