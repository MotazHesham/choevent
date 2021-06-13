<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Event;
use App\Models\Order;
use Auth;

class OrderController extends Controller
{

    public function index(Request $request,$id){
        $user=Auth::user();
        $type=$request->type??'sponsoring';
        $event=Event::findorfail($id);
        if($user->group=='sponsor' && $type=='sponsoring' ){
            $orders=$event->sponsoringOrders()->where('publish','<>',0)->where(function($q)use($user){
                    return $q->where('sponsor_id',null)->orWhere('sponsor_id',$user->id);
            })->get();
        }elseif($user->group=='provider' &&$type=='service' ){
            $orders=$event->serviceOrders()->where('publish','<>',0)
            ->whereIn('category_id',$user->services->pluck('id'))
            ->where(function($q)use($user){
                return $q->where('service_provider_id',null)->orWhere('service_provider_id',$user->id);
            })->get();
        }elseif($user->group=='organizer'){
            $orders=$user->orders->where('type', $type);
        }
        return view('website.orders.'.$type.'.index',compact('orders','user','event'));

    }

  
    public function create(Request $request,$id){
        $user=Auth::user();
        $event=Event::find($id);
        $categories = Category::where('type','service')->get()->pluck('name', 'id');
        $type=$request->type??'sponsoring';
        $orders=Order::where('type',$type)->where('event_id',$event->id)->get();
        
        return view('website.orders.'.$type.'.create',compact('user','event','categories','orders'));
    }

    public function store(StoreOrderRequest $request){
        $input=$request->input();
        $order = Order::create($input);
        $type=$order->type;
        return redirect()->route('website.orders.create',['type'=>$type,'id'=>$order->event_id]);

    }

    public function show($id){
        $order=Order::find($id);
        $user=Auth::user();
        $type=$order->type;
     return view('website.orders.'.$type.'.show',compact('order','user'));

    }

    public function confirm($id){
        $order=Order::find($id);
        $type=$order->type;
        if($type=='sponsoring'){
            $order->sponsor_id=Auth::id();
        }elseif($type=='service'){
            $order->service_provider_id=Auth::id();
        }
        $order->publish=2;
        $order->save();
        return redirect()->route('website.orders.index',['type'=>$type,'id'=>$order->event->id]);
    }
    
    

}