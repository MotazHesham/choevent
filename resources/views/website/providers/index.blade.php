@extends('website.layouts.main')
@section('styles')
<style>
    header{background: #fff;}
    .menu .trigger{color:#a6217b}
    .participating_comp{
        background: none;
        margin-top: 0px;
    }
    .participating_comp .item-content{
       border: solid 1px #dadada;
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
                        <i class="fas fa-long-arrow-alt-{{$arrow_direction}}"></i>&nbsp; {{ trans('website.menu.providers') }}
                </div>      
            </div>
        </div>
    </div>
</section>
<section class="service_organizers bg_custom_1507727948742">
    <div class="container p-50">
        <div class="row">
            <div class="heading">
                <h1>{{ trans('website.menu.providers') }}</h1>
                {{-- <p> الشركات مقدمة الخدمات</p> --}}
            </div>    
        </div>
        <div class="row participating_comp">
            @foreach ($providers as $provider)
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mt-5">
                <div class="team-one__single">
                    <div class="team-one__image">
                    <img src="{{$provider->avatar?$provider->avatar->circle:''}}" alt="">
                    </div><!-- /.team-one__image -->
                    <div class="team-one__content">
                    <h3 class="team-one__name"><a href="#">{{$provider->name}}</a></h3>
                        <!-- /.team-one__name -->
                    <p class="team-one__designation"></p><!-- /.team-one__designation -->
                        <p class="team-one__text">{{$provider->short_description}}</p>
                        <!-- /.team-one__text -->
                    </div><!-- /.team-one__content -->
                </div><!-- /.team-one__single -->
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection