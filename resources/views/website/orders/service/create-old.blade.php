@extends('website.layouts.main')
@section('styles')
<style>
    header{background: #fff;}
    .menu .trigger{color:#a6217b}
    select{ padding: 10px !important;}
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
                                {{-- <div class="search hidden-xs hidden-sm">
                                    <input type="text" placeholder="بحث" id="search">
                                </div> --}}
                            </div>
                            <div class="col-md-5">
                           
                            </div>
                        </header>
                    </div>
                    <div class="user-dashboard">
                        <h1>طلب رعاية</h1>
                        <div class="row">
                    <div class="col-md-12">
                    <form class="form-signin" action="{{route('website.orders.store')}}" method="post">  
                        @csrf
                        <div class="form-group">
                            <label > عنوان الطلب</label>  
                            <input  type="text" class="form-control" name="name" required autofocus="">
                        </div>     
                        <div class="form-group">
                            <label > نوع الخدمة</label>  
                            <select class="form-control" name="category_id" required autofocus="">
                                <option value=""> اختر تصنيف</option>
                                @foreach ($categories as $id=>$category)
                                <option value="{{$id}}">{{$category}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label > الفعالية:</label>  
                            <select class="form-control" name="event_id" required autofocus="">
                                <option value=""> اختر فعالية</option>
                                @foreach ($events as $event)
                                <option value="{{$event->id}}">{{$event->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="type" value="service">
                        <div class="form-group">
                        <label for="comment">تفاصيل الطلب</label>
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