<?php

namespace App\Http\Controllers\Website\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Validator;
use Illuminate\Support\Facades\Hash;

use App\Traits\SendSmsTrait;



class VerifcationController extends Controller
{
    use SendSmsTrait;

    public function getForgetPasswordPage(){
        return view('website.auth.forget_password');
    }

    public function sendPassword(Request $request){
       
       $validator=Validator::make($request->all(), ['mobile'=>'required|exists:users,mobile']);
        if($validator->fails()){
            $msg='يرجى التاكد من إدخال رقم الجوال الصحيح';
            $icon="danger";
        }else{
            $new_pass=rand(0000000,9999999);
            $user=User::where('mobile',$request->mobile)->first();
            $user->password = Hash::make($new_pass);
            $user->save();

            $message="كلمة المرور الجديدة".$new_pass;
            $number='966'.substr($user->mobile,1);
            $this->sendSMS($number, $message);
            

            $msg='تم إرسال رسالة نصية إلى جوالك بها كلمة المرور الجديدة';
            $icon="success";
        }
        return redirect()->back()->with(['forget-msg'=>$msg,'icon'=>$icon]);

    }

    public function getVerifyMobilePage(){
        return view('website.auth.verify');

    }

    public function sendverificationCode(){
        
        $user=Auth::user();
        if(is_null($user->mobile_verified_at)){
            $code=rand(000000,999999);
            $user->code=$code;
            $user->save();
            $number='966'.substr($user->mobile,1);
            $message="كود التفعيل".$code;
            $this->sendSMS($number, $message);

            $msg='تم إرسال رسالة كود التفعيل لجوالك';
        }else{
            $msg='رقم جوال مفعل من قبل';
            $icon='info';
        }
        return view('website.auth.verify')->with('msg',$msg);
    }

    public function verifyMobile(Request $request){
        
        Validator::make($request->all(), ['code'=>'required|numeric']);
        $user=Auth::user();
        if($user->code==$request->code){
            $msg="تم تفعيل رقم الجوال بنجاح";
            $icon='success';
            $user->mobile_verified_at=now();
            $user->save();
        }else{
            $msg="كود التفعيل خطأ ..يرجى التأكد من رسالة كود التفعيل ";
            $icon="danger";
        }

        return redirect()->back()->with(['verify-msg'=>$msg,'icon'=>$icon]);
    }


}