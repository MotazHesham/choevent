<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Consultation;

class ConsultationController extends Controller
{
    public function create(){
        return view('website.consultations.create');
    }

    public function store(Request $request){
        Consultation::create($request->all());
        return redirect()->route('website.home');
    }
   
}
