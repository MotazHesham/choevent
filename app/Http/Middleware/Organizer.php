<?php

namespace App\Http\Middleware;

use Closure;


class Organizer
{
    public function handle($request, Closure $next)
    {
        $user = \Auth::user();

        if ($user) {
           if($user->group=='organizer' &&$user->active==1){
            return $next($request);
           }
        }
        return redirect()->route('website.redirect.organizer');
       

       
    }
}
