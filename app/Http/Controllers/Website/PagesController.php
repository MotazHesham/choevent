<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Event;
class PagesController extends Controller
{
    public function setLang($lang){
        session()->put('language',$lang);
         app()->setLocale($lang);
       return redirect()->route('website.home');

    }


    public function getHomePage(){
     
        $sliderNews=Article::where('main_slider',1)->orderBy('id','desc')->limit(3)->get();
        $news=Article::where('main_slider',0)->orderBy('id','desc')->limit(6)->get();
        $events=Event::has('tickets')->has('user')->where('publish',1)->limit(6)->get();
        return view('website.home',compact('sliderNews','news','events'));
    }
    public function getAboutusPage(){
        return view('website.aboutus');
    }
    public function getContactusPage(){
        return view('website.contactus');
    }
    public function getMarketPage(){
        return view('website.market');
    }
    public function getConditionsPage(){
        return view('website.conditions');
    }

    public function redirectOrganizerPage (){
        return view('website.redirections.organizer');
    }
    public function redirectActivePage(){
        return view('website.redirections.active');
    }
        
    public function doArtisanCommand($command, $param='') {
        if($param){
             $artisan = \Artisan::call($command.' '.$param);
        }else{
             $artisan = \Artisan::call($command); 
        }
            
      
       
        $output = \Artisan::output();
        return $output;
       }
}
