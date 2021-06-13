@extends('website.layouts.main')
@section('styles')
<style>
    header{background: #fff;}
    .menu .trigger{color:#a6217b}
    select{    padding: 6px !important;}
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
                      <i class="fas fa-long-arrow-alt-left"></i>&nbsp; {{ trans('website.menu.booth') }}
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
        
         <p>{{ trans('website.menu.event') }} {{ trans('website.global.name') }}  : {{$event->name}}</p>
         <p>{{ trans('cruds.boothDetail.fields.order') }} : {{$booth->order}}</p>
         <p>{{ trans('cruds.boothDetail.fields.length') }} : {{$booth->length}}</p>
         <p>{{ trans('cruds.boothDetail.fields.width') }} : {{$booth->width}}</p>
         <p>{{ trans('cruds.boothDetail.fields.activity') }} : {{$booth->activity}}</p>
         <p>{{ trans('website.global.booth_price') }} : {{$booth->price}} {{ trans('website.global.sr') }}</p>
         {{-- <a class="btn btn-lg btn-outline mt-4" href="#" id="pay-btn" style="color:#fff"  type="button" >إتمام عملية الدفع</a> --}}
         <button class="btn btn-lg btn-outline" id="pay-btn" type="button" style="color: #fff; border: #fff solid 2px;">{{ trans('website.global.pay') }}</button>   
       </div>
      
     </section>
 @endsection
 @section('scripts')
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
 <script>

var coupon;  var coupon_value=0;
  function applyCoupon(){
    coupon=$('#coupon-input').val();
  }

   $('#pay-btn').click(function(e){
     e.preventDefault();
     $.ajax({
      url: "{{route('website.booth.pay')}}",
      type: 'post',
      data:{
       'booth_id':{{$booth->id}},'coupon_code':coupon
      },
      headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
      },
      success: function(res) {
        if(res.error==1){
          Swal.fire({
                icon: 'error',
                title: "",
                text: res.msg,
                });

        }else{
            
          window.open(res.result.checkoutData.postUrl,'_self');
        }
      }
    });
     
   });
 </script>
 @endsection