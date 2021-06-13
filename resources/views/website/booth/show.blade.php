@extends('website.layouts.main')
@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
<style>
    header{background: #fff;}
    .menu .trigger{color:#a6217b}
    select{    padding: 10px !important;}
    table { width: 100%; text-align: center; margin-top: 20px;}
        tr { border: solid thin #ccc;}
        th, td { padding: 10px;}
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
<section class="book_seat p-50 bg_custom_1507727948742">
  <div class="container">
      <div class="row">
          
           <div class="col-lg-12">
              <div class="book_seat__pic">
                  <div class="theatre__image">
                  <img src="{{$booth->image->url}}" alt="" class="img-fluid">
                  </div><!-- /.team-one__image -->
                 
                
              </div><!-- /.team-one__single -->
          </div><!-- /.col-lg-6 -->
          </div>
     
      
      <div class="row">
      <table role="table">
          <thead role="rowgroup">
            <tr role="row">
              <th role="columnheader">{{ trans('cruds.boothDetail.fields.order') }}</th>
                    <th role="columnheader">{{ trans('cruds.boothDetail.fields.activity') }}</th>
                    <th role="columnheader">{{ trans('cruds.boothDetail.fields.length') }} </th>
                    <th role="columnheader">{{ trans('cruds.boothDetail.fields.width') }}</th>
                    <th role="columnheader">{{ trans('cruds.boothDetail.fields.days') }}</th>
                    <th role="columnheader">{{ trans('website.global.booth_price') }}</th>
              <th role="columnheader">#</th>
            </tr>
          </thead>
          <tbody role="rowgroup">
            @foreach($booth->availableBooth as $el)
            
            <tr role="row">
            <input type="hidden" value="{{$el->id}}">
              <td role="cell">{{$el->order}}</td>
              <td role="cell">{{$el->activity}}</td>
              <td role="cell">{{$el->length}}</td>
              <td role="cell">{{$el->width}}</td>
              <td role="cell">{{$el->days}}</td>
              <td role="cell">{{$el->price}} {{trans('website.global.sr')}}</td>
              <td role="cell"><a class="btn btn-lg btn-outline" href="{{route('website.booth.hire',['event_id'=>$event->id,'booth_id'=>$el->id])}}"  type="button" >إيجار</a></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      
  </div><!-- /.container -->
</section>

@endsection
@section('scripts')
<script>

  // function hireBooth(btn){
  //   var tr=btn.parentElement.parentElement;
  //   let booth_id=tr.children[0].value;
  //   console.log(booth_id);
  //   let event_id={{$event->id}};
  //   $.ajax({
  //       url: "{{url('/booth/pay')}}",
  //       method: "get",
  //      data: { event_id: event_id,
  //           bboth_id:booth_id },
  //              	success: function (response) {
  //                      let url={{url('/')}}+"boo"
  //                  window.open(,"_self");
  //              }
  //           });
  
  // }
</script>

@endsection