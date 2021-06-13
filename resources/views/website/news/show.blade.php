@extends('website.layouts.main')
@section('styles')
<style>
    header{background: #fff;}
    .menu .trigger{color:#a6217b}
</style>
@endsection
@section('content')
@include('website.partials.header-2')
<section>
    <div class=" banner-breadcumb ">
        <div class="breadcrumb-image" style="background-image: url(images/theme_background_color.jpg);">
            <div class="container text-center">
                <div class="breadcrumbs_path">
                        
                        <a href="{{route('website.home')}}">الرئيسية</a>
                        <i class="fas fa-long-arrow-alt-left"></i>&nbsp; الأخبار
                </div>      
            </div>
        </div>
    </div>
</section>
<section class="service_organizers bg_custom_1507727948742">
    <div class="container p-50">
       <div class="row">
            <div class="heading">
                <h1>{{$article->title}}</h1>
            </div>    
        </div>
        <div class="row about">
            <div class="col-md-5 col-xs-12">
                <div class="pic">
                    <img src="{{$article->featured_image?$article->featured_image->url:''}}" class="img-fluid">
                </div>
            </div>
            <div class="col-md-7 col-xs-12">
                <div class="content">
                    <p>
                        {!!$article->description!!}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection