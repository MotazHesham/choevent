
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Choice</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/e0387e9a75.js"></script>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/css/swiper.min.css'>
    {{-- <link rel="stylesheet"  href= "https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />  --}}
    <link rel='stylesheet' href="{{url('css/bootstrap.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <link rel='stylesheet' href="{{asset('css/profile_style.css')}}">
    @php
      $css_site_style='css/site-style_'.app()->getLocale().'.css';    
    @endphp
    <link rel='stylesheet' href="{{asset($css_site_style)}}">
    <link rel="stylesheet" href="{{asset('fonts/stylesheet.css')}}" >
    <link href="{{asset('css/model.css')}}" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel='stylesheet' href="{{asset('css/event_home_slider.css')}}">
    
    <link rel='stylesheet' href="{{asset('css/custom_style.css')}}">
    <link rel='stylesheet' href="{{asset('css/global.css')}}">
    <script>
        window.console = window.console || function(t) {};
      </script>
      <script>
        if (document.location.search.match(/type=embed/gi)) {
          window.parent.postMessage("resize", "*");
        }
      </script>
    @yield('styles')
</head>