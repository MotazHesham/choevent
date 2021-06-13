@extends('website.layouts.main')
@section('styles')
<link rel='stylesheet' href="{{asset('css/custom_profile_'.app()->getLocale().'.css')}}">
<style>
    header{background: #fff;}
    .menu .trigger{color:#a6217b}
    select{    padding: 6px !important;}
    .event-details__price {
    background-color: #f1f1f1;
    text-align: center;
    padding: 20px 50px;
    border-radius: 50px;}
    .event-details__price-amount {
    margin: 0;
    color: #a6217b;
    font-size: 20px;
    font-weight: 600;
    line-height: 1em;
    margin-top: 10px;}
   
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
                     <a href="{{route('website.market')}}"> <i class="fas fa-long-arrow-alt-{{ $arrow_direction}}"></i>&nbsp; {{ trans('website.menu.market') }}</a>
                      <i class="fas fa-long-arrow-alt-{{ $arrow_direction}}"></i>&nbsp; {{ trans('website.menu.booth') }}
              </div>      
          </div>
      </div>
  </div>
</section>
<section class=" bg_custom_1507727948742">
   <div class="container p-50" style="padding-bottom: 0;">
      <div class="row">
        <div class="heading" >
            <h1>{{ trans('website.menu.booth') }} </h1>
          
            </div>    
      </div>
      </div>
        <div class="buyticket">
        <form class="form-signin" action="" method="get">       
           @csrf
            <div class="form-group">
              <label >{{ trans('website.global.select_event') }}:</label>
              <select class="form-control" id="event-id" placeholder="{{ trans('website.global.name') }}" > 
                @foreach($events as $event)
                <option value="{{$event->id}}">{{$event->name}}</option>
                @endforeach
             </select>
            </div>
           
        
            <div class="clear"></div>
                <button class="btn btn-lg btn-outline" id="show-btn" type="button" style="color: #fff; border: #fff solid 2px;">{{ trans('website.global.show_booth') }}</button>   
          </form>
        </div>
     </section>
 @endsection
 @section('scripts')
 <script>
  $('#show-btn').click(function(e){
    e.preventDefault();
    let eventId=$('#event-id').val();
    if(eventId){
        var url ="{{url('/')}}"+"/event/"+eventId+"/booth/show";
        window.open(url,"_self");
    }

  });
 </script>
 @endsection