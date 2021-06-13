@extends('website.layouts.main')
@section('styles')
<link rel="stylesheet" href="sweetalert2.min.css">
<style>
    header{background: #fff;}
    .menu .trigger{color:#a6217b}
    select{    padding: 10px !important;}
  
</style>
@endsection
@section('content')
@include('website.partials.header-2')
@include('website.partials.breadcrumb')
<section class=" bg_custom_1507727948742">
   <div class="container p-50" style="padding-bottom: 0;">
      <div class="row">
        <div class="heading" >
            <h1>التحقق من تذكرة الدخول </h1>
            </div>    
      </div>
      </div>
        <div class="buyticket">
          
            
        </div>
     </section>
    
 @endsection
 @section('scripts')
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
 <script src="sweetalert2.min.js"></script>

 <script>
   @if($status)
   Swal.fire({
  icon: 'success',
  title: "{{$msg}}",
  text: "مرحبا بك ..",

})
  
   @else
   Swal.fire({
  icon: 'error',
  title: "{{$title}}...",
  text: "{{$msg}}",

})
   @endif
 </script>

 @endsection