<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class ProvidersController extends Controller
{
    public function index(){
        $providers=User::where([['active',1],['group','provider']])->paginate(8);
        return view('website.providers.index',compact('providers'));
    }
   
}
