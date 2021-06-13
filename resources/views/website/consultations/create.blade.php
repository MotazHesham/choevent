@extends('website.layouts.main')
@section('styles')
<style>
    header{background: #fff;}
    .menu .trigger{color:#a6217b}
    .one-third{
        width: 100% !important;
    }
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
                        <i class="fas fa-long-arrow-alt-{{$arrow_direction}}"></i>&nbsp; {{ trans('cruds.consultation.title_singular') }}
                </div>      
            </div>
        </div>
    </div>
</section>
<section class="all_event bg_custom_1507727948742">
    <div class="container p-50">
        <div class="row">
            <div class="heading">
                <h1>{{ trans('cruds.consultation.title_singular') }}</h1>
             
            </div>    
        </div>
        <div class="row">
            <div class="video-container" style="margin:2% auto">
                <iframe src="{{url('video/choises.mp4')}}"  height="350" width="700" frameborder="0"></iframe>
               
            <form action="{{route('website.consultations.store')}}" method="post" class="mt-5">
                {{ csrf_field() }}
                <div class="form-group">
                    <p style="color:#A71979">لتقديم طلب فكرة أو ستشارة</p>
                </div>
               <div class="form-group">
                    <input type="text" class="form-control" name="name" placeholder="{{trans('website.register.name')}}" >
                    <input type="number" class="form-control" name="mobile" placeholder="{{trans('website.register.mobile')}}" required>
                    <input type="email" class="form-control" name="email" placeholder="{{trans('website.register.email')}}" >
                    <button type="submit" class="btn btn-primary">طلب</button>
               </div>
            </form>
            </div>
        </div>
    
    </div>
</section>

@endsection
@section('scripts')
<script>
    function imgError(image,defSrc) {
    image.onerror = "";
    image.src = defSrc;
    return true;
}
</script>
@endsection