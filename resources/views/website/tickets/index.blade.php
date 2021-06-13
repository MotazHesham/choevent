@extends('website.layouts.main')
@section('styles')
<style>
    header{background: #fff;}
    .menu .trigger{color:#a6217b}
    select{    padding: 7px !important;}
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
  <div class=" banner-breadcumb ">
      <div class="breadcrumb-image" style="background-image: url(images/theme_background_color.jpg);">
          <div class="container text-center">
              <div class="breadcrumbs_path">
                      
                <?php
                $arrow_direction=(app()->getLocale()=='en')?'right':'left';
                ?>
                <a href="{{route('website.home')}}">{{ trans('website.menu.home') }}</a>
                      <a href="{{route('website.market')}}">  <i class="fas fa-long-arrow-alt-{{$arrow_direction}}"></i>&nbsp; {{ trans('website.menu.market') }}</a>
                      <i class="fas fa-long-arrow-alt-{{$arrow_direction}}"></i>&nbsp;{{ trans('website.menu.tickets') }}
              </div>      
          </div>
      </div>
  </div>
</section>
<section class=" bg_custom_1507727948742">
   <div class="container p-50" style="padding-bottom: 0;">
      <div class="row">
        <div class="heading" >
            <h1>{{ trans('website.menu.tickets') }} </h1>
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
          <form class="form-signin" action="" method="post">       
           @csrf
            <div class="form-group">
              <label >{{ trans('website.global.select_event') }}:</label>
              <select class="form-control" name="event_id" id="event-id" required > 
               <option value="">{{ trans('website.global.select_event') }}</option>
                @foreach($events as $event)
                <option value="{{$event->id}}" @if($event->id ==$id) selected @endif>{{$event->name}}</option>
                @endforeach
             </select>
            </div>
            <div class="form-group">
              <label >{{ trans('website.global.ticket_type') }}:</label>
              <select class="form-control" name="ticket_id" id="ticket-type" required> 
              
              </select>
            </div>
            <div class="form-group">
              <label >{{ trans('website.global.count') }}:</label>
              <select class="form-control" name="tickets_count" id="persons_count" required > 
              </select>
            </div>
            <br>
            
              <div  id="ticket-details" class="event-details__price" style="display:none">
                
              </div>
          <br>
            <div class="clear"></div>
                <button class="btn btn-lg btn-outline" id="pay-btn" type="button" style="color: #fff; border: #fff solid 2px;">{{ trans('website.global.pay') }}</button>   
          </form>
        </div>
     </section>
    
 @endsection
 @section('scripts')
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
 <script>
   var selectedTicket;
    var personsCount=1;
    var ticket_id; var event_id;
    var coupon;  var coupon_value=0;
    function applyCoupon(){
      coupon=$('#coupon-input').val();
      
    }
   

   $('#pay-btn').click(function(e){
     e.preventDefault();
     $.ajax({
      url: "{{route('website.tickets.pay')}}",
      type: 'post',
      data:{
        'event_id':event_id,'tickets_count':personsCount,'ticket_id':ticket_id,'coupon_code':coupon
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
 <script>
    
    if($('#event-id').val()>0){
      event_id= $('#event-id').val();
      getEventTickets(event_id);
    }
   
   $('#event-id').change(function(){
      $('#ticket-details').hide();
      getEventTickets($(this).val());
   });

   function getEventTickets(id){
    $.ajax({
      url: '/event/tickets',
      type: 'post',
      data:{
        'id':id
      },
      headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
      },
      success: function(tickets) {
        $( "#ticket-type" ).empty();
        $('#ticket-type').append('<option value="">اختر نوع التذكرة</option>');
        for (i = 0; i < tickets.length; i++) {
          $('#ticket-type').append('<option value="'+tickets[i].id+'">'+tickets[i].name+'</option>');
        }
      }
    });
  }
//////////////////////////////////////
  $('#ticket-type').change(function(){
    
    if($(this).val()){
      ticket_id=$(this).val();
      getTicket(ticket_id);
    }
  });
  function getTicket(id){
     $.ajax({
      url:'/tickets/'+id+'/show',
      type:'GET',
      success:function(ticket){
        selectedTicket= ticket;
        personsCount=1;
        setTicketDetails(ticket,personsCount);
        $( "#persons_count" ).empty();
        for (i = 1; i <= ticket.max_count; i++) {
          $('#persons_count').append('<option value="'+i+'" >'+i+'</option>');
        }
      }
     });

   }
  //  /////////////////////////////////////////

   $('#persons_count').change(function(){
    personsCount=$(this).val();
    setTicketDetails(selectedTicket,personsCount);
   });
          
  function setTicketDetails(ticket,count){
    $('#ticket-details').empty();
    $('#ticket-details').show();
      $('#ticket-details').append('<div class="row"><div class="event-details__price-text col-md-4">وصف التذكرة : </div><div class="event-details__price-amount col-md-8">'+ticket.description+'</div></div ><div class="row"><div class="event-details__price-text col-md-4">  سعر التذكرة : </div><div class="event-details__price-amount col-md-8">'+ticket.price+' ريال </div></div><div class="row"><div class="event-details__price-text col-md-4">العدد :  </div><div class="event-details__price-amount col-md-8">'+count+'</div></div><div class="row"><div class="event-details__price-text col-md-4">الإجمالى : </div><div class="event-details__price-amount col-md-8">'+ticket.price*count+' ريال </div></div>');
      
   }
 </script>

 @endsection