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
                <h1>{{trans('website.menu.booth')}} </h1>
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
                    <form action="{{route('website.booth.store')}}" method="post" id="main-form" >
                        @csrf
                    <div class="addevent">
                        <div class="row">
                            <div class="col-md-12">             
                                <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                                    <label for="image">{{trans('website.global.upload_photo')}}</label>
                                    <div class="needsclick dropzone" id="image-dropzone"></div>
                                    @if($errors->has('image'))
                                    <span class="help-block" role="alert">{{ $errors->first('image') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                    </div>
                    </form>
       <a  data-popup-open="popup-2" href="#">  <button class="btn btn-lg btn-outline  " type="button" style="color: #fff; border: #fff solid 2px;">{{trans('website.global.add_booth')}}</button>   </a>
        
        </div>
        <div class="row pb-2">
            <table role="table">
                <thead role="rowgroup">
                  <tr role="row">
                    <th role="columnheader">{{ trans('cruds.boothDetail.fields.order') }}</th>
                    <th role="columnheader">{{ trans('cruds.boothDetail.fields.activity') }}</th>
                    <th role="columnheader">{{ trans('cruds.boothDetail.fields.length') }} </th>
                    <th role="columnheader">{{ trans('cruds.boothDetail.fields.width') }}</th>
                    <th role="columnheader">{{ trans('cruds.boothDetail.fields.days') }}</th>
                    <th role="columnheader">{{ trans('website.global.booth_price') }}</th>
                    <th role="columnheader">{{ trans('website.global.status') }}</th>
                    <th role="columnheader">#</th>

                  </tr>
                </thead>
                <tbody role="rowgroup" id="table-body">
                   @if($booth)
                   @foreach($booth->boothDetails as $el)
                    <tr>
                    <td role="cell" class="booth_order">{{$el->order}}</td>
                         <td role="cell">{{$el->activity}}</td>
                         <td role="cell">{{$el->length}}</td>
                         <td role="cell">{{$el->width}}</td>
                         <td role="cell">{{$el->days}}</td>
                         <td role="cell">{{$el->price}} ريال</td>
                         <td role="cell">
                            @if($el->user_id)
                        
                             <span class="badge badge-success">
                             مؤجر
                            
                             @else
                             <span class="badge badge-info">
                                 غير مؤجر
                            @endif
                        </span>
                            </td>
                         <td>
                            @if(!$el->user_id)
                            <form action="{{ route('website.booth.destroy', $el->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('website.global.delete') }}">
                            </form>
                            @endif
                         </td>
                    </tr>
                    @endforeach
                   @endif
            </tbody>
            </table>
            </div>
       
   
        </div>
    </div>
 </div>
 </div>

 </section>
{{--  --}}
<div class="popup" data-popup="popup-2">
    <div class="popup-inner sponsors_inner">
        <form  class="form-signin" action="{{route('website.booth.store')}}" method="post"  >
            @csrf
        
        <input type="hidden" name="event_id" value="{{$event->id}}">
        <input type="hidden" name="name" value="{{$event->name}}">
       <div class="row">
            <div class="col-md-6">
                  <div class="form-group">
                    <label >{{ trans('cruds.boothDetail.fields.order') }}:</label>  
                    <input type="text" name="order"  class="form-control" placeholder="{{ trans('cruds.boothDetail.fields.order') }} " required autofocus="" />
                   </div>
                    <div class="form-group">
                        <label >ا{{ trans('cruds.boothDetail.fields.length') }}:</label>  
                        <input type="text" class="form-control" name="length" placeholder="{{ trans('cruds.boothDetail.fields.length') }} " required autofocus="" />
                   </div>
            </div>
            <div class="col-md-6">
                    <div class="form-group">
                        <label >{{ trans('cruds.boothDetail.fields.activity') }}:</label>
                        <input type="text" class="form-control" name="activity" placeholder="{{ trans('cruds.boothDetail.fields.activity') }}" required autofocus="" />
                    </div>
                    <div class="form-group">
                        <label >ا{{ trans('cruds.boothDetail.fields.width') }}:</label>  
                        <input type="text" class="form-control" name="width" placeholder="{{ trans('cruds.boothDetail.fields.width') }}" required="" autofocus="" />
                    </div>
            </div>
           <div class="col-md-6">
                <div class="form-group">
                    <label >{{ trans('website.global.booth_price') }}:</label>  
                    <input type="number" class="form-control" name="price" placeholder="{{ trans('website.global.booth_price') }}" required="" autofocus="" />
                </div> 
                
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label >{{ trans('cruds.boothDetail.fields.days') }}:</label>  
                <input type="number" class="form-control" name="days" placeholder="{{ trans('cruds.boothDetail.fields.days') }} " required="" autofocus="" />
            </div> 
        </div>
        <div class="col-md-6">
            <button class="btn btn-lg btn-outline" type="submit" >{{ trans('website.global.add') }}</button>   
        </div>
    </div>
        </form>
        <button class="sponsors_inner__button"><a data-popup-close="popup-2" href="#" class="">{{ trans('website.global.close') }}</a></button>

       <a class="popup-close" data-popup-close="popup-2" href="#">x</a>
   </div>
       </div>
{{--  --}}
@endsection
@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
<script>
    Dropzone.options.imageDropzone = {
    url: '{{ route('admin.booths.storeMedia') }}',
    maxFilesize: 20, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    dictDefaultMessage:'اضف صورة مخطط البوثات هنا',
    dictRemoveFile:"حذف الملف",
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 20,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="image"]').remove()
      $('form').append('<input type="hidden" name="image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($booth) && $booth->image)
      var file = {!! json_encode($booth->image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="image" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
<script>
	$(function() {
    //----- OPEN
    $('[data-popup-open]').on('click', function(e)  {
        var targeted_popup_class = jQuery(this).attr('data-popup-open');
        $('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);
 
        e.preventDefault();
    });
 
    //----- CLOSE
    $('[data-popup-close]').on('click', function(e)  {
        var targeted_popup_class = jQuery(this).attr('data-popup-close');
        $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);
 
        e.preventDefault();
    });
});
</script>
@endsection