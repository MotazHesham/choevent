@extends('website.layouts.main')
@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
<link rel='stylesheet' href="{{asset('css/custom_profile_'.app()->getLocale().'.css')}}">
<style>
   header{background: #fff;}
   .menu .trigger{color:#a6217b}
   select{    padding: 7px !important;}
   table { width: 100%; text-align: center; margin-top: 20px;}
   tr { border: solid thin #ccc;}
   th, td { padding: 10px;}
   input , select ,textarea {
       border: 2px solid #e0e0e0  !important;
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
               <h1>{{ trans('website.menu.tickets') }} </h1>
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
               <div class="col-md-4">
                  <p style='color: #fff; '>
                     {{$event->name}}
                  </p>
               </div>
               <div class="col-md-8">
                  <p>سيتم خصم 5% لكل تذكرة مباعة كرسوم خدمة غير شامل الضريبة</p>
               </div>
               <div class="col-md-12">             
              
               </div>
            </div>
            <a  data-popup-open="popup-add-ticket" href="#">  <button class="btn btn-lg btn-outline  " type="submit" style="color: #fff; border: #fff solid 2px;">{{trans('website.global.add_ticket')}}</button>   </a>
         </div>
         <div class="row pb-2">
            <table role="table">
               <thead role="rowgroup">
                  <tr role="row">
                     <th role="columnheader">{{trans('website.global.ticket_type')}}</th>
                     <th role="columnheader">{{trans('website.global.count')}}</th>
                     <th role="columnheader">{{trans('website.global.bought')}}</th>
                     
                     <th role="columnheader">{{trans('website.global.enterence_time')}}</th>
                     <th role="columnheader">{{trans('website.global.ticket_price')}}</th>
                     <th role="columnheader">#</th>
                  </tr>
               </thead>
               <tbody role="rowgroup" id="table-body">
             
                  @foreach($tickets as $ticket)
                  <tr>
                  <td role="cell" class="booth_order">{{$ticket->name}}</td>
                  <td role="cell">{{$ticket->count ?? '--'}}</td>
                     <td role="cell">
                        <span class="badge badge-success">{{$ticket->sold ?? 0}}</span>
                     </td>
                  {{-- <td role="cell">{{$ticket->max_count}}</td> --}}
                  <td role="cell">{{$ticket->entrance ?? '--'}}</td>
                  <td role="cell">{{$ticket->price}}</td>
                  <td>
                     <a  data-popup-open="popup-show-ticket" href="#"> 
                     <button class="btn btn-xs btn-info" onClick="passTicketToModel({{$ticket}});">
                        {{trans('website.global.view')}}
                     </button>
                     </a>
                    @if(!$ticket->sold)
                    <form action="{{ route('website.tickets.destroy', $ticket->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                     <input type="hidden" name="_method" value="DELETE">
                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
                     <input type="submit" class="btn btn-xs btn-danger" value="{{trans('website.global.delete')}}">
                   </form>
                    @endif

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
      <form class="form-signin" action="{{route('website.tickets.store')}}" method="post">
         @csrf
         <input type="hidden" name="event_id" value="{{$event->id}}">
         <input type="hidden" name="name" value="{{$event->name}}">
         <div class="row">
            <div class="col-md-4">
               <div class="form-group">
                  <label >{{trans('website.global.ticket_type')}}:</label>  
                  <input type="text" name="name" class="form-control"  placeholder="{{trans('website.global.ticket_type')}} " required autofocus="" />
               </div>
               <div class="form-group">
                  <label >{{trans('website.global.start_date')}}:</label>  
                  <input type="date" name="start_date" class="form-control" required  autofocus="" />
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  <label >{{trans('website.global.count')}}:</label>  
                  <input type="number" name="count" class="form-control" required placeholder="{{trans('website.global.count')}} " required autofocus="" />
               </div>
               <div class="form-group">
                  <label >{{trans('website.global.end_date')}}:</label>  
                  <input type="date" class="form-control" name="end_date" required placeholder=" " autofocus="" />
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  <label > {{trans('website.global.ticket_max')}}:</label>  
                  <input type="number" class="form-control" name="max_count" required placeholder=" " autofocus="" />
               </div>
               <div class="form-group">
                  <label >{{trans('website.global.enterence_time')}}:</label>  
                  <input type="time" class="form-control" name="entrance"   autofocus="" />
               </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                  <label >{{trans('cruds.event.fields.description')}}:</label>  
                  <textarea  class="form-control" name="description" required  rows="6"></textarea>
               </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                  <label >{{trans('website.global.ticket_price')}}:</label>  
                  <input type="number" class="form-control" required name="price" placeholder=" " autofocus="" />
               </div>
            </div>
            <button class="btn btn-lg btn-outline"  type="submit" >{{trans('website.global.add')}}</button>   
         </div>
      </form>
      <button class="sponsors_inner__button"><a data-popup-close="popup-add-ticket" href="#" class="">{{trans('website.global.close')}}</a></button>
      <a class="popup-close" data-popup-close="popup-add-ticket" href="#">x</a>
   </div>
</div>
{{-- end add ticket --}}
<div class="popup" data-popup="popup-show-ticket">
   <div class="popup-inner sponsors_inner">
      <form class="form-signin" >
         <div class="row">
            <table id="ticket-details" class="table table-bordered table-striped">
               
            </table>

         </div>
      </form>
      <button class="sponsors_inner__button"><a data-popup-close="popup-show-ticket" href="#" class="">إغلاق</a></button>
      <a class="popup-close" data-popup-close="popup-show-ticket" href="#">x</a>
   </div>
</div>
{{-- end popups --}}
@endsection
@section('scripts')
<script>
   function passTicketToModel(ticket){
      $('#ticket-details').empty();
      $('#ticket-details').append('<tr><th>نوع التذكرة</th><td>'+ticket.name+'</td></tr><tr><th>تاريخ بداية البيع</th><td>'+ticket.start_date+'</td></tr><tr><th>تاريخ نهاية البيع</th><td>'+ticket.end_date+'</td></tr><tr><th>موعد الدخول</th><td>'+ticket.entrance+'</td></tr><tr><th>العدد الكلى</th><td>'+ticket.count+'</td></tr><tr><th>أقصى عدد أفراد على التذكرة الواحدة</th><td>'+ticket.max_count+'</td></tr><tr><th>السعر</th><td>'+ticket.price+'</td></tr><tr><th>الوصف</th><td>'+ticket.description+'</td></tr>');

   }
</script>
@endsection