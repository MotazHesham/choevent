@extends('website.layouts.main')
@section('styles')
<link rel='stylesheet' href="{{asset('css/custom_profile_'.app()->getLocale().'.css')}}">
<style>
    header{background: #fff;}
    .menu .trigger{color:#a6217b}
    select{ padding: 7px;}
    input , select ,textarea {
       border: 2px solid #e0e0e0  !important;
    }
</style>
@endsection
@section('content')
@include('website.partials.header-2')
<section class="profile bg_custom_1507727948742">
     <div class="container-fluid p-50">
        <div class="container-fluid display-table">
            <div class="row display-table-row">
                @include('website.partials.sidebar')
                <div class="col-md-10 col-sm-11 display-table-cell v-align">
                    <!--<button type="button" class="slide-toggle">Slide Toggle</button> -->
                    <div class="row">
                        <header>
                            <div class="col-md-7">
                                <nav class="navbar-default pull-left">
                                    <div class="navbar-header">
                                    <button type="button" class="navbar-toggle collapsed" data-toggle="offcanvas" data-target="#side-menu" aria-expanded="false">
                                            <span class="sr-only">Toggle navigation</span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                        </button>
                                    </div>
                                </nav>
                               
                            </div>
                            <div class="col-md-5">
                           
                            </div>
                        </header>
                    </div>
                    <div class="user-dashboard">
                        <h1>عرض رعاية</h1>
                        <div class="row">
                    <div class="col-md-12">
                    <form class="form-signin" action="{{route('website.offers.store')}}" method="post">  
                        @csrf
                        <div class="form-group">
                            <label > عنوان العرض</label>  
                            <input  type="text" class="form-control" name="name" required autofocus="">
                        </div>
                        <div class="form-group">
                            <label > قيمة العرض</label>  
                            <input  type="number" class="form-control" name="price" required autofocus="">
                        </div>     
                        <input type="hidden" name="type" value="sponsoring">
                        <input type="hidden" name="order_id" value="{{$order->id}}">
                        <input type="hidden" name="event_id" value="{{$event->id}}">
                        <div class="form-group">
                        <label >تفاصيل العرض</label>
                        <textarea class="form-control" rows="6" name="description"></textarea>
                        </div>
                    <button class="btn btn-lg btn-primary " type="submit">إرسال</button>
                </form>
                </div>
            </div>
        </div>
                    
            </div>
 </section>
@endsection