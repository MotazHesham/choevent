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
                        <i class="fas fa-long-arrow-alt-{{$arrow_direction}}"></i>&nbsp; {{ trans('website.menu.sponsors') }}
                </div>      
            </div>
        </div>
    </div>
</section>
<section class="sponsors bg_custom_1507727948742">
    <div class="container p-50">
        <div class="row mb-7" >
            <div class="heading">
                <h1>{{ trans('website.menu.sponsors') }}</h1>
                {{-- <p>  الشركات الراعية للفعاليات </p> --}}
            </div>    
        </div>
        <div class="row">
            @foreach($sponsors as $sponsor)
            <div class="col-md-3  col-xs-6">
                <div class="spon">
                <a onclick="setPopupContent('{{$sponsor->name}}','{{$sponsor->description}}','{{$sponsor->avatar?$sponsor->avatar->url:null }}')"  data-popup-open="popup-2" href="#"> <img src="{{$sponsor->avatar?$sponsor->avatar->url:''}}" alt="" class="img-fluid"> </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
 <!----------sponsors------------->
<div class="popup" data-popup="popup-2">
    <div class="popup-inner sponsors_inner">
        <div class="pic"><img src="images/DmqkXG6WwAAI15h.jpg" class="img-fluid"></div>
        <h2>بوابة الترفية</h2>
        <p>أنشئت بوابة الترفيه لتقدم تراخيص الأنشطة والخدمات التابعة للهيئة العامة للترفيه التي تعد الجهة المشرعة لهذا القطاع الحيوي في المملكة العربية السعودية، والتي تهدف إلى تطوير وتنظيم قطاع الترفيه ودعم بنيته التحتية، بالتعاون مع مختلف الجهات. وتعمل البوابة على تسهيل الأعمال للراغبين في تقديم الخدمات الترفيهية على اختلاف أنواعها، كما يمكن من خلالها الاطلاع على الاشتراطات والضوابط اللازمة للعمل في القطاع.
        </p>
        <button class="sponsors_inner__button"><a data-popup-close="popup-2" href="#" class="">إغلاق</a></button>
        <a class="popup-close" data-popup-close="popup-2" href="#">x</a>
    </div>
   
</div>
        <!----------sponsors------------->
    
    
    
    </section>
@endsection
@section('scripts')
<script>
   function setPopupContent(name,description='نبذة عن الشركة',avatarSrc){
    $('.popup-inner >h2').text(name);
    $('.popup-inner >p').text(description);
    $('.popup-inner > .pic > img').attr('src',avatarSrc);
   }

</script>
@endsection