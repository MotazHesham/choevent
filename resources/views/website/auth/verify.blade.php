@extends('website.layouts.main')
@section('styles')
<style>
    header{background: #fff;}
    .menu .trigger{color:#a6217b}
    input , select ,textarea {
       border: 2px solid #e0e0e0  !important;
    }
</style>
@endsection
@section('content')
@include('website.partials.header-2')
<section>
    <div class="banner-breadcumb ">
        <div class="breadcrumb-image" style="background-image: url(images/theme_background_color.jpg);">
            <div class="container text-center">
                <div class="breadcrumbs_path">
                    <?php
                    $arrow_direction=(app()->getLocale()=='en')?'right':'left';
                    ?>
                      
                        <a href="{{route('website.home')}}">{{ trans('website.menu.home') }}</a>
                        <i class="fas fa-long-arrow-alt-{{$arrow_direction}}"></i>&nbsp; {{ trans('website.menu.verify_mobile') }}
                </div>      
            </div>
        </div>
    </div>
</section>
<section class="login bg_custom_1507727948742">
    <div class="container p-50">
        @if(session('verify-msg'))
      
        <div class="row">
        <div class= " col-lg-12 alert alert-{{session('icon') ??'info'}}">
           {{session('verify-msg')}}
        </div>
        </div>
        @endif
        <div class="row">
            <div class="heading">
                <h1>{{ trans('website.menu.verify_mobile') }}</h1>
                <p> {{trans('website.messages.verify')}} </p>
            </div>    
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="olduser">
                    <form method="POST" action="{{ route('website.mobile.verify') }}">
                        @csrf      
                        <input type="number" class="form-control" name="code" placeholder="{{ trans('website.menu.verification_code') }}" required=""/>   
                           
                       <a href="{{route('website.verification.send')}}" style="color:#A71979"> 
                        {{ trans('website.global.resend_code') }}
                       </a>
                       
                                    <div class="clear"></div>
                        <button class="btn btn-lg btn-primary btn-block " type="submit">{{ trans('website.global.verify') }}</button>   
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection