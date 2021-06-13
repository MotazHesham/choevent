<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class SponsorsController extends Controller
{
    public function index(){
        $sponsors=User::where([['active',1],['group','sponsor']])->paginate(8);
        return view('website.sponsors.index',compact('sponsors'));
    }
   
}
