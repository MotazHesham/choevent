<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Configration;
use App\Models\Coupon;
use App\Traits\NoonPaymentTrait;
use Auth;
class PaymentController extends Controller
{
    use NoonPaymentTrait;
    public function getRegisterationFeePage(Request $request){
        $user_group=Auth::user()?Auth::user()->group:'organizer';
        $register_fee=Configration::where('item',$user_group.'_register')->first()->value;
        $vat=Configration::where('item','vat')->first()->value;
        $coupon_discount_value=0;
        $coupon=Coupon::where('code',$request->coupon)->first();
        if($coupon){
            if($coupon->type=='register'||$coupon->type=='all'){
                $coupon_discount=$coupon->discount;
                $coupon_discount_value=$register_fee*$coupon_discount/100;
            }
        }
            
        $vat_value=$vat*$register_fee/100;
       $total=$register_fee+$vat_value-$coupon_discount_value;
      
        return view('website.payment.register_fee',compact('register_fee','vat_value','coupon_discount_value','total'));
       
    }
    public function payRegistrationFee(Request $request){
        $user_group=Auth::user()?Auth::user()->group:'organizer';
        $register_fee=Configration::where('item',$user_group.'_register')->first()->value;
        $vat=Configration::where('item','vat')->first()->value;
        $coupon_discount_value=0;
        $coupon=Coupon::where('code',$request->coupon)->first();
        if($coupon){
            if($coupon->type=='register'||$coupon->type=='all'){
                $coupon_discount=$coupon->discount;
                $coupon_discount_value=$register_fee*$coupon_discount/100;
            }
        }
            
        $vat_value=$vat*$register_fee/100;
       $total=$register_fee+$vat_value-$coupon_discount_value;
        $user=Auth::user();
        $merchant=now()->getTimestamp();
        $user->marchent_id=$merchant;
            $user->save();
            $paymentResponse= $this->initiate("$merchant", $total,"$user->group",url('api/users/payments/feedback'));
            return redirect()->to($paymentResponse['result']['checkoutData']['postUrl']);
    }
   
}