@extends('website.layouts.main')
@section('styles')
<link rel='stylesheet' href="{{asset('css/custom_profile_'.app()->getLocale().'.css')}}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
<style>
   header{background: #fff;}
   .menu .trigger{color:#a6217b}
   select{    padding: 7px !important;}
   table { width: 100%; text-align: center; margin-top: 20px;}
   tr { border: solid thin #ccc;}
   th, td { padding: 10px;}
   input , select ,textarea {
       border: 2px solid #e0e0e0  !important;
       color:#a0a0a0 !important;
    }
   /*
   Max width before this PARTICULAR table gets nasty. This query will take effect for any screen smaller than 760px and also iPads specifically.
   */
   .dz-clickable{
   color:#555;
   }
   @media
   only screen 
   and (max-width: 760px), (min-device-width: 768px) 
   and (max-device-width: 1024px)  {
   /* Force table to not be like tables anymore */
   table, thead, tbody, th, td, tr {
   display: block;
   }
   /* Hide table headers (but not display: none;, for accessibility) */
   thead tr {
   position: absolute;
   top: -9999px;
   right: -9999px;
   }
   tr {
   margin: 0 0 1rem 0;
   }
   tr:nth-child(odd) {
   background: #f1f1f1;
   }
   td {
   /* Behave  like a "row" */
   border: none;
   border-bottom: 1px solid #eee;
   position: relative;
   padding-right: 50%;
   }
   td:before {
   /* Now like a table header */
   position: absolute;
   /* Top/left values mimic padding */
   top: 0;
   right: 6px;
   width: 45%;
   padding-left: 10px;
   white-space: nowrap;
   }
   /*
   Label the data
   You could also use a data-* attribute and content for this. That way "bloats" the HTML, this way means you need to keep HTML and CSS in sync. Lea Verou has a clever way to handle with text-shadow.
   */
   td:nth-of-type(1):before { content: "الرقم"; }
   td:nth-of-type(2):before { content: "النشاط"; }
   td:nth-of-type(3):before { content: "الطول"; }
   td:nth-of-type(4):before { content: "العرض"; }
   td:nth-of-type(5):before { content: "إيجار"; }
   }
</style>
@endsection
@section('content')
@include('website.partials.header-2')
<section class="profile bg_custom_1507727948742">
   <div class="container-fluid p-50">
      <div class="container-fluid display-table">
         <div class="row">
            <div class="heading" >
               <h1> طلبات الخدمة </h1>
               @if(session('success-msg'))
               <div class="alert alert-success col-md-12">
                  {{session('success-msg')}}
               </div>
              @endif
            </div>
         </div>
          <div class="row display-table-row">
              @include('website.partials.sidebar')
              <div class="col-md-10 col-sm-11 display-table-cell v-align">
               <div class="user-dashboard">
                  <div class="addevent">
                     <div class="row">
                        <div class="col-lg-12">
                           <p style='color: #fff; '>
                              طلبات خدمة الفعالية  : {{$event->name}}
                           </p>
                        </div>
                        <div class="col-md-12">             
                     
                        </div>
                     </div>
                     <a  data-popup-open="popup-add-ticket" href="#">  <button class="btn btn-lg btn-outline  " type="submit" style="color: #fff; border: #fff solid 2px;">إضافة طلب</button>   </a>
                  </div>
                  <div class="row pb-2">
                     <table role="table">
                        <thead role="rowgroup">
                           <tr role="row">
                              <th role="columnheader">الطلب</th>
                              <th role="columnheader">نوع الخدمة</th>
                              <th role="columnheader">تاريخ طلب الخدمة</th>
                              <th role="columnheader">عدد أيام الخدمة</th>
                              <th role="columnheader">السعر</th>
                              <th role="columnheader">الحالة</th>
                              <th role="columnheader">مقدم الخدمة</th>
                              <th role="columnheader">#</th>
                           </tr>
                        </thead>
                        <tbody role="rowgroup" id="table-body">
                     
                           @foreach($orders as $order)
                           <tr>
                           <td role="cell" class="booth_order">{{$order->name}}</td>
                           <td role="cell"> {{$order->category->name}}</td>
                           <td role="cell"> {{$order->setup_date}}</td>
                           <td role="cell"> {{$order->days}}</td>
                           <td role="cell">{{$order->price}} ريال</td>
                           <td>
                                 @if($order->publish==0)
                                 <span class="badge badge-warning ">معلق
                                 </span>                                                
                                 @elseif($order->publish==1)
                                 <span class="badge badge-info ">
                                 تم النشر
                                 </span>
                                 @elseif($order->publish==2) 
                                 <span class="badge badge-success ">
                                 تحت الإجراء
                                 </span>
                                 @endif
                           </td>
                           <td role="cell">
                              @if($order->service_provider)
                           <a href="#">
                            {{$order->service_provider->name}}
                           </a>
                              @else
                              -- 
                            @endif
                            </td>
                        
                           <td>
                              <a  data-popup-open="popup-show-order" href="#"> 
                                 <button class="btn btn-xs btn-primary" style="background: #17a2b8;border:#17a2b8" onClick="passOrderToModel({{$order}});">
                                    تفاصيل
                                 </button>
                              </a>
                              <a   href="{{route('website.offers.index',['order_id'=>$order->id,'type'=>'service'])}}"> 
                                 <button class="btn btn-xs btn-primary">
                                    العروض
                                 </button>
                              </a>
                                 
                              
                           </td>
                        
                           </tr>
                           @endforeach
                     
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
{{-- popups --}}
{{-- popup for adding tickets --}}
<div class="popup" data-popup="popup-add-ticket">
   <div class="popup-inner sponsors_inner">
      <form class="form-signin" action="{{route('website.orders.store')}}" method="post">
         @csrf
         <input type="hidden" name="event_id" value="{{$event->id}}">
         <input type="hidden" name="type" value="service">
         
         <div class="row">
            <div class="col-md-6">
               <div class="form-group">
                  <label >الاسم:</label>  
                  <input type="text" name="name" class="form-control"  placeholder="اسم الطلب " required autofocus="" />
               </div>
               <div class="form-group">
                <label >تاريخ طلب الخدمة:</label>  
                <input type="date" name="setup_date" class="form-control"   autofocus="" />
                </div>
             
               
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label >نوع الخدمة:</label>  
                    <select name="category_id"  class="form-control">
                        <option value="">اختر نوع الخدمة</option>
                        @foreach($categories as $id=>$category)
                            <option value="{{$id}}">{{$category}}</option>
                        @endforeach
                    </select>
                 </div>
                 <div class="form-group">
                    <label >عدد أيام الخدمة:</label>  
                    <input type="number" name="days" class="form-control"   autofocus="" />
                </div>
               
              
            </div>
            {{-- <div class="col-md-4">
                <div class="form-group">
                    <label >السعر:</label>  
                    <input type="number" name="price" class="form-control" placeholder="السعر " required autofocus="" />
                 </div>
            </div> --}}
            <div class="col-md-12">
                <div class="form-group">
                    <label >الوصف:</label>  
                    <textarea  class="form-control" name="description"  rows="6"></textarea>
                 </div>
            </div>
            
            
            <button class="btn btn-lg btn-outline"  type="submit" >إضافة</button>   
         </div>
      </form>
      <button class="sponsors_inner__button"><a data-popup-close="popup-add-ticket" href="#" class="">إغلاق</a></button>
      <a class="popup-close" data-popup-close="popup-add-ticket" href="#">x</a>
   </div>
</div>
{{-- end add ticket --}}
<div class="popup" data-popup="popup-show-order">
   <div class="popup-inner sponsors_inner">
      <form class="form-signin" >
         <div class="row">
            <table id="order-details" class="table table-bordered table-striped">
               
            </table>

         </div>
      </form>
      <button class="sponsors_inner__button"><a data-popup-close="popup-show-order" href="#" class="">إغلاق</a></button>
      <a class="popup-close" data-popup-close="popup-show-order" href="#">x</a>
   </div>
</div>
{{-- end popups --}}
@endsection
@section('scripts')
<script>
   function passOrderToModel(order){
      $('#order-details').empty();
      $('#order-details').append('<tr><th>اسم الطلب</th><td>'+order.name+'</td></tr><tr><th>سعر الطلب</th><td>'+order.price+'</td></tr><tr><th>الوصف</th><td>'+order.description+'</td></tr>');

   }
</script>
@endsection