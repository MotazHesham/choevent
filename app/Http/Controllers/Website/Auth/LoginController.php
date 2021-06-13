<?php

namespace App\Http\Controllers\Website\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Validator;

class LoginController extends Controller
{

    public function getLoginPage(){
        return view('website.auth.login');
    }

    public function login(Request $request){
        Validator::make($request->all(), [
            'email'=>'required|email|exists:users,email',
            'password'=>'required|string']);
       if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
           return redirect()->route('website.home');
       }else{
           return redirect()->back()->with('login-error-msg','بريد إلكترونى أو كلمة مرور غير صحيحة');
       }

}

}