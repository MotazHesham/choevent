<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class OrganizersController extends Controller
{
    public function index(){
        $organizers=User::where([['active',1],['group','organizer']])->paginate(6);
        return view('website.organizers.index',compact('organizers'));
    }
   
    public function show($id){
        $organizer=User::find($id);
        $events_count=$organizer->events()->where('publish',1)->count();
        $last_events=$organizer->events()->where('publish',1)->limit(3)->get();
        return view('website.organizers.show',compact('organizer','events_count','last_events'));
    }
}
