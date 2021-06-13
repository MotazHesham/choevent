@extends('website.layouts.main')
@section('styles')
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
            <h1>شراء تذاكر </h1>
            {{-- <p> هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</p> --}}
            </div>    
      </div>
      </div>
        <div class="buyticket">
         <p > صفحة الدفع</p>
         <p>اسم الفعالية : {{$event->name}}</p>
         <p>عدد التذاكر : {{$tickets_count}}</p>
         <p>سعر التذكره : {{$ticket->price}} ريال</p>
         <p>إجمالى السعر : {{$ticket->price*$tickets_count}} ريال</p>
        </div>
     </section>
 @endsection