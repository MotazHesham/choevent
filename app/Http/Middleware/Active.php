<?php

namespace App\Http\Middleware;
use Auth;
use Closure;


class Active
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        return  $this->isUserLoggedIn()?$this->isMobileVerified($user)?$this->isUserPaidRegisterFee($user)?$this->isAccountActive($user)?$this->passRequest($request,$next):$this->redirectActivationPage():$this->redirectPayRegisterFeePage():$this->redirectMobileVerificationPage():$this->redirectLoginPage();
    
    }


    private function isUserLoggedIn():bool{
        return Auth::check();
    }
    private function isMobileVerified($user):bool{
        return $user->mobile_verified_at!=null;
    }
    private function isAccountActive($user):bool{
        return $user->active==1;
    }
    private function passRequest($request,$next){
        return $next($request);
    }
    private function redirectActivationPage(){
        return redirect()->route('website.redirect.active');
    }
    private function redirectMobileVerificationPage(){
        return redirect()->route("website.mobile.verify.page");
    }
    private function redirectLoginPage(){
        return redirect()->route('website.login');
    }
    private function getUserGroup($user):string{
        return $user->group;
    }
    
    private function isUserGroupOrganizerOrProvider($user):bool{
        
        return $user->group=='organizer'||$user->group=='provider';
    }

    private function isUserPaidRegisterFee($user):bool{
       
       return $this->isUserGroupOrganizerOrProvider($user)?$user->paid>1:true;
       
    }

    private function redirectPayRegisterFeePage(){
        
        return redirect()->route('website.payment.register');
    }
    
    
    
}
