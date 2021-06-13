@extends('website.layouts.main')
@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
<style>
    header{background: #fff;}
    .menu .trigger{color:#a6217b}
    #map {
    height: 200px;  
    width: 100%;  
   }
   .controls {
        margin-top: 10px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
      }
   .needsclick{
        border-radius: 30px;
        border: solid thin #ddd;
        margin-top: 10px;
        color: #b4b4b4;
    }
    select{
      padding: 5px !important;
    }
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
                      <i class="fas fa-long-arrow-alt-{{$arrow_direction}}"></i>&nbsp; {{trans('website.menu.add_new_event')}}
              </div>      
          </div>
      </div>
  </div>
</section>
<section class=" team-one team-page bg_custom_1507727948742">
  <div class="container p-50" style="padding-bottom: 0;">
    <div class="row">
      <div class="heading" >
        <h1> {{trans('website.menu.add_new_event')}} </h1>
      </div> 
     </div>
     <div class="row">
       <div class="col-md-12">
        @if(isset($errors)&& count($errors)>0)   
        <div class="alert alert-danger" role="alert">
          <ul>
           @foreach($errors->all() as $error)
          <li class="">{{$error}}</li>
          @endforeach
          </ul>
        </div>
        @elseif(Session::has('msg'))
        <div class="alert alert-success">{{ Session::get('msg') }}</div>
        @endif
       </div>
     </div>
    <div class="addevent">
    
      <form method="POST" action="{{ route("website.events.store") }}" enctype="multipart/form-data">
        @csrf
      <input name="user_id" type="hidden" value="{{Auth::id()}}">
      <div class="row">
        <div class="col-md-6">
            <div class="form-group">
              <label >{{ trans('cruds.event.fields.name') }}:</label>
              <input type="text" class="form-control" name="name" placeholder="{{ trans('cruds.event.fields.name') }}" required="" autofocus="" />
            </div>
            <div class="form-group">
              <label >  {{ trans('cruds.event.fields.category') }}</label>
              <select class="form-control" name="category_id"  >
                <option value="">{{ trans('global.pleaseSelect') }}</option>
                @foreach($activities as $id=>$activity)
              <option value="{{$id }}">{{$activity}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="comment">  {{ trans('cruds.event.fields.description') }}:</label>
              <textarea class="form-control" rows="8"  name="description"></textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
              <label >{{ trans('cruds.event.fields.city') }}</label>
              <select class="form-control" name="city_id" > 
                <option value="">{{ trans('global.pleaseSelect') }}</option>
                @foreach($cities as $id=>$city)
                <option value="{{$id}}">{{$city}}</option>
                @endforeach
              </select>
            </div>
              {{-- address --}}
            <div class="form-group">
                <label >{{ trans('cruds.event.fields.address') }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" >
                <input type="hidden" id="location_url" name="location_url">
            </div>
            <div class="form-group">
              <label >{{ trans('website.global.set_location') }}</label>
              <div class="map-responsive">
                <input class="controls" id="autocomplete" placeholder="{{ trans('website.messages.location') }}" type="text" />
                <div id="map"></div>
                <input  type="hidden" name="lat" id="lat"  >
                <input  type="hidden" name="lng" id="lng"  >
              </div>
            </div>
        </div>
      </div>
       <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="birthday">{{ trans('cruds.event.fields.start_at') }}:</label>
            <input type="date"  name="start_at" class="form-control" style="direction: ltr;"  >
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="birthday">{{ trans('cruds.event.fields.end_at') }}:</label>
            <input type="date"  name="end_at" class="form-control" style="direction: ltr;"  >
          </div>
        </div>
       </div>
        {{-- <h4 class=""> شروط تطبق على المشاركين --}}
            </h4>
        <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="" class="">{{ trans('cruds.event.fields.sex') }}</label>
                  <select name="sex" id="" class="form-control">
                  <option value="" >الكل</option>
                  <option value="male" >male</option>
                  <option value="female" >female</option>
                  </select>
                </div>
               </div>
              <div class="col-md-6">
                <div class="form-group">
                <label for="" >{{ trans('cruds.event.fields.nationality') }}</label>
                <select name="nationality"  class="form-control">
                  <option value="">الكل</option>
                  <option value="saudi">سعودى</option>
                 </select>
               </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="" >{{ trans('cruds.event.fields.age_min') }}</label>
                  <input type="number" name="age_min" class="form-control">
              </div>
            </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="" >{{ trans('cruds.event.fields.age_max') }}</label>
                  <input type="number" name="age_max" class="form-control">
                </div>
              </div>
        </div>
           
          <div class="row">
             <div class="col-md-12">
              
                <div class="form-group {{ $errors->has('featured_image') ? 'has-error' : '' }}">
                  <label for="featured_image">{{ trans('cruds.event.fields.featured_image') }}</label>
                  <div class="needsclick dropzone" id="featured_image-dropzone">
                  </div>
                  @if($errors->has('featured_image'))
                      <span class="help-block" role="alert">{{ $errors->first('featured_image') }}</span>
                  @endif
                  <span class="help-block">{{ trans('cruds.event.fields.featured_image_helper') }}</span>
                  <p>لظهور الصورة بجوده عالية أقل أبعاد للصورة لابد أن تكون (770*447)</p>
              </div>
              </div>

          </div>
       <button class="btn btn-lg btn-outline " type="submit" style="color: #fff; border: #fff solid 2px;">{{trans('website.global.save')}}</button>   
     </form>
    </div>
   </div>
</section>

@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
<script>
  // dropzone
  Dropzone.options.featuredImageDropzone = {
    url: '{{ route('admin.events.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    dictDefaultMessage:"{{trans('website.global.upload_photo') }}",
    dictRemoveFile:"{{trans('website.global.delete_photo') }}",
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="featured_image"]').remove()
      $('form').append('<input type="hidden" name="featured_image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="featured_image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($event) && $event->featured_image)
      var file = {!! json_encode($event->featured_image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="featured_image" value="' + file.file_name + '">')
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
  //end dropzone
  var marker,map, places,autocomplete,infowindow;
 function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 8,
        center: {lat:23.8859, lng: 45.0792 }
    });
    infowindow = new google.maps.InfoWindow({
            content: document.getElementById('myform')
    });
    autocomplete = new google.maps.places.Autocomplete((
            document.getElementById('autocomplete')),{});
    places = new google.maps.places.PlacesService(map);
    autocomplete.addListener('place_changed', onPlaceChanged);
    google.maps.event.addListener(map, 'click', function(event) {
        if(typeof(marker)=='object'){
            marker.setMap(null);
        }
        marker = new google.maps.Marker({
            position: event.latLng,
            map: map
        });
        setFormInputs(event.latLng,'');
    });

    if(typeof(marker)=='object'){
        google.maps.event.addListener(marker, 'click', function() {
             infowindow.open(map, marker);
             showInfoWindow();
         });
    }

function onPlaceChanged() {
    var place = autocomplete.getPlace();
   if (place.geometry) {
        if(typeof(marker)=='object'){
                marker.setMap(null);
        }
    marker = new google.maps.Marker({
        position: place.geometry.location,
        map: map
    });
    setFormInputs(place.geometry.location,place.formatted_address,place.url);
    console.log(place.url);
    map.panTo(place.geometry.location);
    map.setZoom(15);
   } else {
    document.getElementById('autocomplete').placeholder = 'Enter address';
   }
  }
 function setFormInputs(latlng,formatted_address,url){
    document.getElementById('lat').value=latlng.lat();
    document.getElementById('lng').value=latlng.lng();
    document.getElementById('address').value=formatted_address;
    document.getElementById('location_url').value=url;
  } 
  function showInfoWindow() {
  var marker = this;
  places.getDetails({placeId: marker.placeResult.place_id},
      function(place, status) {
        if (status !== google.maps.places.PlacesServiceStatus.OK) {
          return;
        }
      
      });
}

 }
</script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBUo5n1BET7OgaDiiQNpP5qnnIZaTpQBHU&libraries=places&callback=initMap">
</script>
    
@endsection