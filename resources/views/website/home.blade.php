@extends('website.layouts.main')
@section('content')
@include('website.partials.header')
@include('website.partials.slider')
<section class="home_blockes">
    <div class="container">
        <div class="row">
            <div class="homeblock  bg_yellow">
                <a href="{{route('website.sponsors.index')}}">
                    <div class="icon"><img src="images/sponsor_icon.png"></div>
                    <h4> {{ trans('website.menu.sponsors') }} </h4>
                </a>
            </div>
            <div class="homeblock bg_purple" >
                <a href="{{route('website.organizers.index')}}">
                    <div class="icon"><img src="images/event_manager.png"></div>
                    <h4>{{ trans('website.menu.organizers') }} </h4>
                </a>
            </div>
            <div class="homeblock bg_pink ">
                <a href="{{route('website.providers.index')}}">
                    <div class="icon"><img src="images/services-icon.png"></div>
                    <h4>{{ trans('website.menu.providers') }} </h4>
                </a>
            </div>
            <div class="homeblock  bg_lightblue">
            <a href="{{route('website.market')}}">
                    <div class="icon"><img src="images/ticket-icon.png"></div>
                    <h4>{{ trans('website.menu.market') }}  </h4>
                </a>
            </div>
        </div>
    </div>
</section>
 <section class="home-events all_event ">
    <div class="container">
        <div class="home_head">
            <h1> {{ trans('website.menu.events') }}</h1>
            <p>  <a href="{{route('website.events.index')}}">( {{ trans('website.menu.allevents') }} )</a> </p>
        </div>
        <div class="row" style="direction:ltr; ">
            <div class="customNavigation">
                <a class="btn gray prev"><i class="fas fa-chevron-left"></i></a>
                <a class="btn gray next"><i class="fas fa-chevron-right"></i></a>
            </div>
            <div id="slider-carousel" class="owl-carousel" >
                @foreach($events as $event)
                <div class="item">
                    <div class="clash-card barbarian">
                    <div class="clash-card__image clash-card__image--barbarian">
                    <img src="{{$event->featured_image?$event->featured_image->home:$event->default_image->home}}" class="img-fluid" onerror='imgError(this,"{{$event->default_image->home}}");'> 
                    </div>
                    @php 
                     $organizer=$event->user;
                @endphp
                @if($organizer)
                    <div class="clash-card__level clash-card__level--barbarian"><a href="{{route('website.organizers.show',['id'=>$organizer->id])}}"> {{$organizer->name}} </a></div>
                    @endif
                    <div class="clash-card__unit-name"><a href="#"> {{$event->name}} </a></div>
                    <div class="clash-card__unit-description">
                        {{$event->short_description}}
                    </div>
                <a href="{{route('website.events.show',['id'=>$event->id])}}" class="blog-slider__button"> {{ trans('website.global.more') }}</a>
                    </div> <!-- end clash-card barbarian-->
                </div>
                @endforeach
            </div>
        </div>
    </div>
 </section>
 <section class="home-news all_event ">
    <div class="container">
        <div class="home_head">
            <h1>  {{ trans('website.menu.news') }}</h1>
            <p><a href="{{route('website.news.index')}}">( {{ trans('website.menu.allnews') }} )</a> </p>
        </div>
        <div class="row" style="direction:ltr; ">
            <div class="customNavigation">
                <a class="btn gray eventevent"><i class="fas fa-chevron-left"></i></a>
                <a class="btn gray eventnext"><i class="fas fa-chevron-right"></i></a>
            </div>
            <div id="event-carousel" class="owl-carousel" >
                @foreach ($news as $item)
                <div class="item">
                    <div class="home-new">
                        <div class="row">
                            <div class="col-md-4  col-xs-12">
                                <div class="new-pic">
                                <img src="{{$item->featured_image?$item->featured_image->url:''}}" class="img-fluid"> 
                                </div>
                            </div>
                            <div class="col-md-8  col-xs-12">
                                <div class="new-details">
                                    <div class="home-new-date"><span>{{$item->created_at->format('d/ m/ Y')}}</span></div>
                                    <div class="home-new-name"><a href="#"> {{$item->title}} </a></div>
                                    <!--<div class="home-new-description">  {!!$item->short_description!!}</div>-->
                                    <a href="{{route('website.news.show',['id'=>$item->id])}}" class="news-home-button"> {{ trans('website.global.more') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    
                @endforeach
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