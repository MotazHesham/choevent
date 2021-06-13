<header >
    <div class="container inside header-container" >
        <div class="row">
            <div class="col-md-8 col-xs-12 buttons-div">   
                @php
                $lang=app()->getLocale();
              @endphp
             
              @if($lang=='ar')
               <a href="{{route('website.language.set',['locale'=>'en'])}}" class="top-button  english-button"  data-target="#"> {{  'EN'}} </a>
               @elseif($lang=='en')
               <a href="{{route('website.language.set',['locale'=>'ar'])}}" class="top-button english-button"  data-target="#"> {{  'العربية'}} </a>
               @endif
                @if(Auth::check())
                <a href="{{route('website.profile')}}" class="top-button  english-button"  data-target="{{route('website.profile')}}">
                    <img class="img-icon" src="{{url('images/icons/user.png')}}">
                    {{ trans('website.header.profile') }}
                </a>
                @else
                <a href="{{route('website.login')}}" class="top-button  login-button"  data-target="{{route('website.login')}}"> 
                    {{ trans('website.header.login') }}
                </a>
                <a href="{{route('website.register')}}" class="top-button  register-button"  data-target="{{route('website.register')}}">
                    {{ trans('website.header.register') }}
                </a>
                @endif

                <a data-popup-open="popup-1" href="#" class="top-button  search-button"  data-target="" >
                    <img src="{{url('images/loupe.png')}}" alt="search">
                </a>
               
            </div>
            <div class="col-md-4 logo_search">    
                <a href="{{route('website.home')}}"><div class="logo" ></div> </a> 
                
            </div>
        </div>
    </div>
</header>