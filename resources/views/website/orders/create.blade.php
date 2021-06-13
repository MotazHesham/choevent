@extends('website.layouts.main')
@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
<style>
    header{background: #fff;}
    .menu .trigger{color:#a6217b}
    .needsclick{
        border-radius: 30px;
        border: solid thin #ddd;
        margin-top: 10px;
    }
    select{
        padding:8px !important;
    }
   
</style>
@endsection
@section('content')
@include('website.partials.header-2')
@include('website.partials.breadcrumb')
<section class="profile bg_custom_1507727948742">
    <div class="container-fluid p-50">
        <div class="container-fluid display-table">
            <div class="row display-table-row">
                @include('website.partials.sidebar')
               <div class="col-md-10 col-sm-11 display-table-cell v-align">
                <div class="user-dashboard">
                    <form method="POST" action="{{ route("website.profile.update") }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                    <div class="row">
                       <div class="col-md-12">
                            <h4>طلب رعاية</h4>
                       </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <form class="form-signin">       
                                <div class="form-group">
                                    <label >اسم الفعالية:</label>  
                                    <input type="text" class="form-control" name="username" placeholder="اسم الفعالية" required="" autofocus="" />
                                </div>
                                <div class="form-group">
                                    <label for="comment">وصف الفعالية</label>
                                    <textarea class="form-control" rows="5" id="comment"></textarea>
                                </div>
                            </form>
                            <button class="btn btn-lg btn-primary " type="submit">طلب</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</section>

@endsection