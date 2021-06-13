<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Ticket;
use App\Models\Booth;
use App\Models\BoothDetail;
use App\Models\Configration;
use App\Models\Coupon;
use Illuminate\Support\Facades\Mail;
use App\Mail\BoothMail;
use Auth;
use App\Traits\NoonPaymentTrait;

class BoothController extends Controller
{
    use NoonPaymentTrait;
    public function index(){
        $events=Event::has('booth')->where('publish',1)->orderBy('id','desc')->get();
        return view('website.booth.index',compact('events'));
    }

   public function create($id){
       $user=Auth::user();
        $event=Event::find($id);
        $booth=Booth::where('event_id',$event->id)->first();
       return view('website.booth.create',compact('event','booth','user'));
   }

   public function store(Request $request){

     $booth=Booth::where('event_id',$request->event_id)->first();
     if($booth){
        $booth->update($request->all());
     }else{
        $booth = Booth::create($request->all());
     }
   if ($request->input('image', false)) {
            if (!$booth->image || $request->input('image') !== $booth->image->file_name) {
                if ($booth->image) {
                    $booth->image->delete();
                }

                $booth->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
            }
        } elseif ($booth->image) {
            $booth->image->delete();
        }
        $input =$request->all();
        $input['booth_id']=$booth->id;
         BoothDetail::create($input);
    return redirect()->route('website.booth.create',['id'=>$booth->event_id]);

   }
 
   public function show($id){
       $event=Event::findorfail($id);
       $booth=Booth::where('event_id',$id)->first();
       return view('website.booth.show',compact('event','booth'));
   }

   public function hire($event_id,$booth_id){

    $event=Event::findorfail($event_id);
    $main_booth=Booth::where('event_id',$event_id)->first();
    $booth=$main_booth->boothDetails->where('id',$booth_id)->first();
    $booth->user_id=Auth::id();
    $booth->save();
    
    return view('website.booth.hire',compact('event','booth'));
   }

   public function pay(Request $request){
    $merchant=now()->getTimestamp();
    $booth=BoothDetail::findorfail($request->booth_id);
    $booth->marchent_id=$merchant;
    $booth->save();
    // 
    $vat=Configration::where('item','vat')->first()->value;
    $vat_value=$vat*$booth->price/100;
    if($request->coupon_code){
        $coupon_discount_value=0;
        $coupon=Coupon::where('code',$request->coupon_code)->first();
        if($coupon){
            if($coupon->type=='booth'||$coupon->type=='all'){
                $coupon_discount=$coupon->discount;
                $coupon_discount_value=$booth->price*$coupon_discount/100;
            }
        }
    }
    $total=$booth->price+$vat_value-$coupon_discount_value;
    // 
   
    return $this->initiate("$merchant",$total,'booth',url('api/booth/payments/feedback'));
   
   }

   public function getPaymentFeedback(Request $request){

        $orderResponse= $this->getOrder($request->orderId);
        $booth=BoothDetail::where('marchent_id',$request->merchantReference)->first();
        $booth->order_response=$orderResponse;
        $booth->init_response=$request->input();
        if($orderResponse['result']['order']['status']=='3DS_RESULT_VERIFIED'){
            $booth->paid=$orderResponse['result']['order']['amount'];
            $booth->save();
            // Mail::to(Auth::user())->send(new BoothMail($event,$booth));
        }
        
        return redirect()->route('website.home');
        //4000000000000002 
   }

   public function destroy($id){
    $booth=BoothDetail::find($id);
    $booth->delete();
    return redirect()->back()->with('success-msg','تم حذف البوث بنجاح');
}
   
}
