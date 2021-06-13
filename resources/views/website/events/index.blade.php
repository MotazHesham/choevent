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
                      <i class="fas fa-long-arrow-alt-{{$arrow_direction}}"></i>&nbsp; {{ trans('website.menu.events') }}
              </div>      
          </div>
      </div>
  </div>
</section>
<section class="all_event bg_custom_1507727948742">
  <div class="container p-50">
    <div class="row">
      <div class="heading">
          <h1>{{ trans('website.menu.events') }}</h1>
            {{-- <p> هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</p> --}}
      </div>    
    </div>
    <div class="row">
      @foreach($events as $event)
      <div class="col-md-3  col-xs-6 mb-2">
        <div class="clash-card barbarian">
          <div class="clash-card__image clash-card__image--barbarian">
          <img src="{{$event->featured_image?$event->featured_image->index:$event->default_image->index}}" class="img-fluid"
           onerror='imgError(this,"{{$event->default_image->index}}");'> 
          </div>
        <div class="clash-card__level clash-card__level--barbarian">{{$event->user?$event->user->name:''}}</div>
        <div class="clash-card__unit-name">{{$event->name}}</div>
          <div class="clash-card__unit-description">
           {{$event->short_description}}
          </div>
          <div class="clash-card__unit-stats clash-card__unit-stats--barbarian clearfix">
          <div class="one-third border-right">
          <div class="stat">{{$event->count}}</div>
            <div class="stat-value">{{ trans('website.global.set') }}</div>
          </div>
          <div class="one-third">
          <div class="stat">{{$event->ticket_price}}</div>
          <div class="stat-value">{{ trans('website.global.sr') }}</div>
          </div>
          <div class="one-third border-left">
          <a href="{{route('website.events.show',['id'=>$event->id])}}">
            <div class="stat">{{ trans('website.global.more') }}</div>
            <div class="stat-value"> {{ trans('website.global.here') }}</div></a>
          </div>
        </div>
      </div> <!-- end clash-card barbarian-->
    </div>
    @endforeach
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