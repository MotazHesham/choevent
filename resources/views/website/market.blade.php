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
                    <?php
                    $arrow_direction=(app()->getLocale()=='en')?'right':'left';
                    ?>
                        <a href="{{route('website.home')}}">{{ trans('website.menu.home') }}</a>
                        <i class="fas fa-long-arrow-alt-{{$arrow_direction}}"></i>&nbsp; {{ trans('website.menu.market') }}
                </div>      
            </div>
        </div>
    </div>
</section>
<section class="tickets bg_custom_1507727948742">
     <div class="container p-50">
        <div class="row">
            <div class="heading">
                <h1> {{ trans('website.menu.market') }} </h1>
                <p> </p>
            </div>    
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="tickets_icon">
            <a href="{{route('website.tickets.index')}}">
            <img src="images/tickets_icon.png" class="img-fluid"> </a>
            
            </div>
            </div>
            
            
        <div class="col-md-6">
            <div class="newevent_icon">
            <a href="{{route('website.booth.index')}}"> <img src="images/add_event_icon.png" class="img-fluid"></a>
            
            </div>
            </div>
            
           
        </div>
     
        </div>
        </section>
@endsection