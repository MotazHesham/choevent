<?php

namespace App\Http\Controllers\Website\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use Auth;


class ProfileController extends Controller
{
    public function getProfilePage(){
        $user=Auth::user();
        $services = Category::where('type','service')->pluck('name', 'id');
        return view('website.auth.profile',compact('user','services'));

    }
    
    public function updateProfile(Request $request){
        $user=Auth::user();
        $user->update($request->all());
        $user->services()->sync($request->input('services', []));
        if ($request->input('avatar', false)) {
            if (!$user->avatar || $request->input('avatar') !== $user->avatar->file_name) {
                if ($user->avatar) {
                    $user->avatar->delete();
                }

                $user->addMedia(storage_path('tmp/uploads/' . $request->input('avatar')))->toMediaCollection('avatar');
            }
        } elseif ($user->avatar) {
            $user->avatar->delete();
        }
        $group=$user->group??'admin';
       
        return redirect()->back();

    }

}