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
                        
                        <a href="{{route('website.home')}}">الرئيسية</a>
                        <i class="fas fa-long-arrow-alt-left"></i>&nbsp; منظمى الفعاليات
                </div>      
            </div>
        </div>
    </div>
</section>
<section class="team-details bg_custom_1507727948742">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="team-details__content">
                <h2 class="team-details__title"> {{$organizer->name}}</h2><!-- /.team-details__title -->
                    <p class="team-details__text">{!!$organizer->description!!}</p><!-- /.team-details__text -->
             
<div class="event-details__meta">
                    <a href="{{route('website.events.index',['organizer_id'=>$organizer->id])}}" class="event-details__meta-link">
                        <span class="event-details__meta-icon">
                          <i class="fas fa-calendar-week" aria-hidden="true"></i><!-- /.far fa-calendar -->
                        </span><!-- /.event-details__icon -->
                    الفعاليات السابقة :<span>{{$events_count}}</span>
                    </a><!-- /.event-details__meta-link -->
                  
                    {{-- <a href="#" class="event-details__meta-link">
                        <span class="event-details__meta-icon">
                          <i class="fas fa-map-marker-alt" aria-hidden="true"></i><!-- /.far fa-user-circle -->
                        </span><!-- /.event-details__icon -->
                        المكان: <span>الدمام, مسرح إثراء</span>
                    </a><!-- /.event-details__meta-link -->
                   --}}
                    {{-- <a href="#" class="event-details__meta-link">
                        <span class="event-details__meta-icon">
                           <i class="fa fa-globe-asia" aria-hidden="true"></i><!-- /.far fa-flag -->
                        </span><!-- /.event-details__icon -->
                          <span>www.domainname.com</span>
                    </a><!-- /.event-details__meta-link --> --}}
                   
                </div>
                  
                    
                       <h2 class="team-details__title"> اخر الفاعليات </h2><!-- /.team-details__title -->
                    
                    <ul class="list-unstyled team-details__event-list">
                        @foreach($last_events as $event)
                        <li>
                        <a href="{{route('website.events.show',['id'=>$event->id])}}">  <img src="{{$event->featured_image?$event->featured_image->preview:$event->default_image->preview}}" class="img-fluid" alt=""
                            onerror='imgError(this,"{{$event->default_image->preview}}");'> ></a>
                        </li>
                        @endforeach
                    </ul>
                    
                    
                </div><!-- /.team-details__content -->
            </div><!-- /.col-lg-6 -->
            <div class="col-lg-6">
                <div class="team-one__single">
                    <div class="team-one__image">
                    <img src="{{$organizer->avatar?$organizer->avatar->organizer_page:''}}" alt="" class="img-fluid">
                    </div><!-- /.team-one__image -->
                    <div class="team-one__content">
                        <h2 class="team-one__name"><a href="#">{{$organizer->name}}</a></h2>
                        <!-- /.team-one__name -->
                        <p class="team-one__designation">{{$organizer->employee_name}}</p><!-- /.team-one__designation -->

                    </div><!-- /.team-one__content -->
                  
                </div><!-- /.team-one__single -->
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
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