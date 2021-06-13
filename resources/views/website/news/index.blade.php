@extends('website.layouts.main')
@section('styles')
<style>
    header{background: #fff;}
    .menu .trigger{color:#a6217b}
    .one-third{
        width: 100% !important;
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
                        
                        <a href="{{route('website.home')}}">الرئيسية</a>
                        <i class="fas fa-long-arrow-alt-left"></i>&nbsp; الأخبار
                </div>      
            </div>
        </div>
    </div>
</section>
<section class="all_event bg_custom_1507727948742">
    <div class="container p-50">
        <div class="row">
            <div class="heading">
                <h1>الأخبار</h1>
                <p> كل الأخبار</p>
            </div>    
        </div>
        <div class="row">
            @foreach ($news as $item)
            <div class="col-md-4  col-xs-6 mb-5">
                <div class="clash-card barbarian">
                    <div class="clash-card__image clash-card__image--barbarian">
                    <img src="{{$item->featured_image?$item->featured_image->index:$item->default_image->index}}" class="img-fluid"
                    onerror='imgError(this,"{{$item->default_image->index}}");'> 
                    </div>
                    {{-- <div class="clash-card__level clash-card__level--barbarian">اسم المقدم</div> --}}
                        <div class="clash-card__unit-name">{{$item->title}}</div>
                            <div class="clash-card__unit-description">
                                
                                <!--{!!$item->short_description!!}-->
                            </div>
                            <div class="clash-card__unit-stats clash-card__unit-stats--barbarian clearfix">
                                
                                <div class="one-third border-left">
                                <a href="{{route('website.news.show',['id'=>$item->id])}}">
                                        للمزيد هنا
                                    </a>
                                </div>
                            </div>
                </div> <!-- end clash-card barbarian-->
            </div>
            @endforeach 
            <div>
                {{$news->links()}}
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