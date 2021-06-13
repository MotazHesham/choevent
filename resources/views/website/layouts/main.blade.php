<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
@include('website.partials.head')
<body class="page">
    @include('website.partials.menu')
    @yield('header')
<div class="warp">
  
    @yield('content')
</div>
@include('website.partials.footer')
</body>