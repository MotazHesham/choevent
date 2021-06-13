@extends('website.layouts.main')
@section('styles')
<style>
    header{background: #fff;}
    .menu .trigger{color:#a6217b}
    select{    padding: 10px !important;}
    .event-details__price {
    background-color: #f1f1f1;
    text-align: center;
    padding: 15px;
    border-radius: 50px;
    width: 100%;}
    .event-details__price-text {
      margin-top: 10px;
    }
    .event-details__price-amount {
    margin: 0;
    color: #a6217b;
    font-size: 16px;
    font-weight: 600;
    line-height: 1em;
    margin-top: 10px;}
</style>
@endsection
@section('content')
@include('website.partials.header-2')
<section>
    <section class=" bg_custom_1507727948742">
        <div class="container p-50" style="padding-bottom: 0;">
           <div class="row">
             <div class="heading" >
                 <h1>{{ trans('website.global.register_fee') }} </h1>
                 {{-- <p> هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</p> --}}
                 </div>    
           </div>
           </div>
           <div id="coupon-div" style="margin: 1% auto; max-width: 500px;text-align: center;">
            <input type="text" id="coupon-input" name="coupon" placeholder="{{ trans('website.global.add_coupon') }}" style="display: inline-block;padding: 10px 57px;text-align: center;
            border-radius: 20px;
            border: 2px solid #a6217b;
            outline: none;
            margin: 0px;">
            <button type="button" onclick="applyCoupon();" class="btn btn-primary"> {{ trans('website.global.apply') }}</button>
          </div>
             <div class="buyticket">
              {{-- <p > صفحة الدفع</p> --}}
              
              <p>{{ trans('website.global.register_fee') }} :  {{ $register_fee }} {{ trans('website.global.sr') }}</p>
              @if($vat_value>0)<p>{{ trans('website.global.vat') }} :+ {{ $vat_value}} {{ trans('website.global.sr') }} </p>@endif
             @if($coupon_discount_value>0) <p>{{ trans('website.global.coupon') }} : - {{ $coupon_discount_value}} {{ trans('website.global.sr') }}</p>@endif
              <p>{{ trans('website.global.total') }} : {{ $total}} {{ trans('website.global.sr') }}</p>

              <br>
              <div class="clear"></div>
                <button class="btn btn-lg btn-outline" id="pay-btn" type="button" style="color: #fff; border: #fff solid 2px;">{{ trans('website.global.pay') }}</button> 
             </div>
             
          </section>
    
 @endsection
 @section('scripts')
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
 <script>
   function applyCoupon(){
     coupon=$('#coupon-input').val();
     window.open("{{url('payment/register_fee')}}"+"?coupon="+coupon,"_self")
   }
   $('#pay-btn').click(function(){
    coupon="{{$_GET['coupon']?? ''}}";
    window.open("{{url('payment/register_fee/pay')}}"+"?coupon="+coupon,"_self");
  });
  
 </script>

 @endsection