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
                        
                        {{-- <a href="{{route('website.home')}}">الرئيسية</a>
                        <i class="fas fa-long-arrow-alt-left"></i>&nbsp; {{$event->name}} --}}
                </div>      
            </div>
        </div>
    </div>
</section>
<section class="event-details course-one bg_custom_1507727948742">
    <div class="container p-50">
        <div class="row">
            <div class="col-lg-8">
                @php 
                $organizer=$event->user;
                @endphp
                @if($organizer)
                <p class="event-details__author">
                <img src="{{$organizer->avatar?$organizer->avatar->thumbnail:'images/team-1-1.jpg'}}" alt=""> {{ trans('cruds.event.fields.organizer') }}:
                <a href="{{route('website.organizers.show',['id'=>$organizer->id])}}"> {{$organizer->name}}</a> 
                </p>
                @endif
                <div class="event-details__top">
                    <div class="event-details__top-left">
                    <h2 class="event-details__title">{{$event->name}}</h2>
                    </div>
                    <!-- /.event-details__top-left -->
                    @if($event->category)
                    <div class="event-details__top-right">
                       
                    <a href="{{route('website.events.index',['category_id'=>$event->category->id])}}" class="course-one__category">{{$event->category->name}}</a><!-- /.course-one__category -->
                    </div>
                    @endif
                    <!-- /.event-details__top-right -->
                </div>
              
                <div class="event-details__image">
                <img src="{{$event->featured_image?$event->featured_image->show:$event->default_image->show}}" alt="" class="img-fluid"
                onerror='imgError(this,"{{$event->default_image->show}}");'>
                    <i class="far fa-heart"></i><!-- /.far fa-heart -->
                </div>
                <div class="event-details__overview">
                    <p>
                    {{$event->description}}     
                    </p>
                </div>
            </div>
            <div class="col-lg-4"> 
                <div class="event-details__price">
                    <p class="event-details__price-text">{{trans('website.global.ticket_price')}} </p><!-- /.event-details__price-text -->
                    <p class="event-details__price-amount">{{$event->ticket_price}} {{trans('website.global.sr')}} </p><!-- /.event-details__price-amount --> 
                    {{-- <form class="form-signin" action="{{route('website.tickets.pay')}}" method="post">        --}}
                        {{-- @csrf --}}
                    {{-- <input type="hidden" name="event_id" value="{{$event->id}}">
                    <input type="hidden" name="tickets_count" value="1"> --}}
                    <a href="{{route('website.tickets.index',['id'=>$event->id])}}" class="btn btn-lg btn-primary event-details__price-btn">{{trans('website.global.buy_ticket')}}</a><!-- /.thm-btn -->
                    {{-- </form> --}}
                </div>
                <div class="event-details__meta">
                    <a href="#" class="event-details__meta-link">
                        <span class="event-details__meta-icon">
                            <i class="fas fa-calendar-week"></i><!-- /.far fa-calendar -->
                        </span><!-- /.event-details__icon -->
                        {{trans('website.global.start_date')}} : <span> {{$event->start_date}} </span>
                    </a><!-- /.event-details__meta-link -->
                            <a href="#" class="event-details__meta-link">
                                <span class="event-details__meta-icon">
                                      <i class="fas fa-calendar-week"></i><!-- /.far fa-calendar -->
                                </span><!-- /.event-details__icon -->
                                {{trans('website.global.end_date')}} : <span> {{$event->end_date}} </span>
                            </a><!-- /.event-details__meta-link -->
                            <a href="#" class="event-details__meta-link">
                                <span class="event-details__meta-icon">
                                  <i class="fas fa-map-marker-alt"></i><!-- /.far fa-user-circle -->
                                </span><!-- /.event-details__icon -->
                                {{trans('website.global.city')}} : <span> {{$event->city->name}} </span>
                            </a><!-- /.event-details__meta-link -->
                            {{-- <a href="#" class="event-details__meta-link">
                                <span class="event-details__meta-icon">
                                  <i class="far fa-clock"></i><!-- /.fas fa-play -->
                                </span><!-- /.event-details__icon -->
                                الوقت : <span>من 8 الى 12 مساءً</span>
                            </a><!-- /.event-details__meta-link --> --}}
                            <a href="{{$event->location_url}}" class="event-details__meta-link" target="_blank">
                                <span class="event-details__meta-icon">
                                   <i class="fa fa-globe-asia"></i><!-- /.far fa-flag -->
                                </span><!-- /.event-details__icon -->
                                {{trans('website.global.location_on_map')}}  <span></span>
                            </a><!-- /.event-details__meta-link -->
                           
                        </div>           
                                  
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