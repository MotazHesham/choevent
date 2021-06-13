<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
class NewsController extends Controller
{
    public function index(){
        $news=Article::where('main_slider',0)->latest()->paginate(6);
        return view('website.news.index',compact('news'));
    }
    

    public function show($id){
        $article=Article::find($id);
        return view('website.news.show',compact('article'));
    }

    
   
}
