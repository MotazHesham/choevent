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
                        <i class="fas fa-long-arrow-alt-{{$arrow_direction}}"></i>&nbsp; {{ trans('website.menu.contactus') }}
                </div>      
            </div>
        </div>
    </div>
</section>
<section class="login bg_custom_1507727948742">
        
        
    <div class="container p-50">
        
        
        
        <div class="row">
        <div class="heading">
            <h1> {{ trans('website.menu.contactus') }}</h1>
            {{-- <p> هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</p> --}}
            </div>    
        </div>
        
      
        
        <div class="row">
        
        <div class="col-md-6">
            <div class="olduser">
             <form class="form-signin">       
      <h6 class="form-signin-heading">{{ trans('website.global.send') }} {{ trans('website.global.message') }}</h6>
      <input type="text" class="form-control" name="name" placeholder="{{ trans('website.global.name') }}" required="" autofocus="">
      <input type="text" class="form-control" name="email" placeholder="{{ trans('website.global.email') }}" required="" autofocus="">
     
  <textarea class="form-control" rows="5" id="comment"></textarea>
      <button class="btn btn-lg btn-primary " type="submit">{{ trans('website.global.send') }}</button>   
    </form>
            
            </div>
			
			<div class="socialmedia">
			<h6 class="form-signin-heading  pr-5 pt-3">{{ trans('website.global.followus') }}:</h6>
    			<div class="col-md-12">
                    <ul class="social-network social-circle">
                        {{-- <li><a href="#" class="icoRss" title="Rss"><i class="fas fa-rss"></i></a></li> --}}
                        {{-- <li><a href="#" class="icoFacebook" title="Facebook"><i class="fab fa-facebook"></i></a></li> --}}
                        <li><a href="https://twitter.com/choices_events?s=11" class="icoTwitter" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                        {{-- <li><a href="#" class="icoGoogle" title="Google +"><i class="fab fa-google-plus"></i></a></li> --}}
                        <li><a href="https://www.linkedin.com/in/choices-events-8522a01b7/" class="icoLinkedin" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>
                        <li><a href="https://instagram.com/choices_events?igshid=sgryu58jzn5p" class="icoinsta" title="instagram"><i class="fab fa-instagram"></i></a></li>
                    </ul>				
				</div>

			</div>
			
            </div>
            
             <div class="col-md-6">
                <div class="contact-info">
                    <h3> {{ trans('website.global.contacts') }} </h3>
                     <br />
                 <div class="contacts">
                     <li > <div style="direction: ltr;"> ‭+966568295029  <i class="fas fa-phone"></i> </div> </li>
                      <li> <i class="fas fa-envelope"></i>  info@choevent.com</li>
                 </div>
                     
                     
                      </div>
            </div>
        </div>
     
        </div>
    </section>
@endsection