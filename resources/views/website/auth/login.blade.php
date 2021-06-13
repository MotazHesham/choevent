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
    <div class=" banner-breadcumb ">
        <div class="breadcrumb-image" style="background-image: url(images/theme_background_color.jpg);">
            <div class="container text-center">
                <div class="breadcrumbs_path">
                    <?php
                    $arrow_direction=(app()->getLocale()=='en')?'right':'left';
                    ?>
                        <a href="{{route('website.home')}}">{{ trans('website.menu.home') }}</a>
                        <i class="fas fa-long-arrow-alt-{{ $arrow_direction}}"></i>&nbsp; {{ trans('website.header.login') }}
                </div>      
            </div>
        </div>
    </div>
</section>
<section class="login bg_custom_1507727948742">
    <div class="container p-50">
        @if(session('login-error-msg'))
      
        <div class="row">
        <div class= " col-lg-12 alert alert-danger">
           {{session('login-error-msg')}}
        </div>
        </div>
        @endif
        <div class="row">
            <div class="heading">
                <h1>{{ trans('website.header.login') }}</h1>
               
            </div>    
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="olduser">
                    <form method="POST" action="{{ route('website.log-in') }}">
                        @csrf      
                        <input type="email" class="form-control {{ $errors->has('email') ? ' has-error' : '' }}" name="email" placeholder="{{ trans('website.global.email') }}" required="" autofocus="" />
                        
                            @if($errors->has('email'))
                                <p class="help-block">
                                    {{ $errors->first('email') }}
                                </p>
                            @endif
                        <input type="password" class="form-control {{ $errors->has('password') ? ' has-error' : '' }}" name="password" placeholder="{{ trans('website.global.password') }}" required=""/>      
                            @if($errors->has('password'))
                                <p class="help-block">
                                    {{ $errors->first('password') }}
                                </p>
                            @endif
                            <div class="row">
                                <div class="col-6">
                                    <label class="checkbox">
                                        <input type="checkbox" name="remember" id="rememberMe" > {{ trans('website.global.rememberme') }}
                                      </label>
                                </div>
                                <div class="col-6 text-{{$arrow_direction}}">
                                   <a href="{{route('website.password.forget')}}"  style="color:#A71979">
                                    {{ trans('website.global.forgetpassword') }}
                                   </a>
                                </div>
                            </div>
                      
                                    <div class="clear"></div>
                        <button class="btn btn-lg btn-primary btn-block " type="submit">{{ trans('website.global.login') }}</button>   
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection