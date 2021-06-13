@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.event.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.events.update", [$event->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">{{ trans('cruds.event.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $event->name) }}">
                            @if($errors->has('name'))
                                <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.event.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                            <label for="address">{{ trans('cruds.event.fields.address') }}</label>
                            <input class="form-control" type="text" name="address" id="address" value="{{ old('address', $event->address) }}">
                            @if($errors->has('address'))
                                <span class="help-block" role="alert">{{ $errors->first('address') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.event.fields.address_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('lat') ? 'has-error' : '' }}">
                            <label for="lat">{{ trans('cruds.event.fields.lat') }}</label>
                            <input class="form-control" type="number" name="lat" id="lat" value="{{ old('lat', $event->lat) }}" step="0.0000000001">
                            @if($errors->has('lat'))
                                <span class="help-block" role="alert">{{ $errors->first('lat') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.event.fields.lat_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('lng') ? 'has-error' : '' }}">
                            <label for="lng">{{ trans('cruds.event.fields.lng') }}</label>
                            <input class="form-control" type="number" name="lng" id="lng" value="{{ old('lng', $event->lng) }}" step="0.0000000001">
                            @if($errors->has('lng'))
                                <span class="help-block" role="alert">{{ $errors->first('lng') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.event.fields.lng_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                            <label for="description">{{ trans('cruds.event.fields.description') }}</label>
                            <textarea class="form-control" name="description" id="description">{{ old('description', $event->description) }}</textarea>
                            @if($errors->has('description'))
                                <span class="help-block" role="alert">{{ $errors->first('description') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.event.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('start_at') ? 'has-error' : '' }}">
                            <label for="start_at">{{ trans('cruds.event.fields.start_at') }}</label>
                            <input class="form-control datetime" type="text" name="start_at" id="start_at" value="{{ old('start_at', $event->start_at) }}">
                            @if($errors->has('start_at'))
                                <span class="help-block" role="alert">{{ $errors->first('start_at') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.event.fields.start_at_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('end_at') ? 'has-error' : '' }}">
                            <label for="end_at">{{ trans('cruds.event.fields.end_at') }}</label>
                            <input class="form-control datetime" type="text" name="end_at" id="end_at" value="{{ old('end_at', $event->end_at) }}">
                            @if($errors->has('end_at'))
                                <span class="help-block" role="alert">{{ $errors->first('end_at') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.event.fields.end_at_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('age_max') ? 'has-error' : '' }}">
                            <label for="age_max">{{ trans('cruds.event.fields.age_max') }}</label>
                            <input class="form-control" type="number" name="age_max" id="age_max" value="{{ old('age_max', $event->age_max) }}" step="1">
                            @if($errors->has('age_max'))
                                <span class="help-block" role="alert">{{ $errors->first('age_max') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.event.fields.age_max_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('age_min') ? 'has-error' : '' }}">
                            <label for="age_min">{{ trans('cruds.event.fields.age_min') }}</label>
                            <input class="form-control" type="number" name="age_min" id="age_min" value="{{ old('age_min', $event->age_min) }}" step="1">
                            @if($errors->has('age_min'))
                                <span class="help-block" role="alert">{{ $errors->first('age_min') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.event.fields.age_min_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('nationality') ? 'has-error' : '' }}">
                            <label>{{ trans('cruds.event.fields.nationality') }}</label>
                            <select class="form-control" name="nationality" id="nationality">
                                <option value disabled {{ old('nationality', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Event::NATIONALITY_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('nationality', $event->nationality) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('nationality'))
                                <span class="help-block" role="alert">{{ $errors->first('nationality') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.event.fields.nationality_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('sex') ? 'has-error' : '' }}">
                            <label>{{ trans('cruds.event.fields.sex') }}</label>
                            <select class="form-control" name="sex" id="sex">
                                <option value disabled {{ old('sex', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Event::SEX_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('sex', $event->sex) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('sex'))
                                <span class="help-block" role="alert">{{ $errors->first('sex') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.event.fields.sex_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('ticket_count') ? 'has-error' : '' }}">
                            <label for="ticket_count">{{ trans('cruds.event.fields.ticket_count') }}</label>
                            <input class="form-control" type="number" name="ticket_count" id="ticket_count" value="{{ old('ticket_count', $event->ticket_count) }}" step="1">
                            @if($errors->has('ticket_count'))
                                <span class="help-block" role="alert">{{ $errors->first('ticket_count') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.event.fields.ticket_count_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('ticket_start') ? 'has-error' : '' }}">
                            <label for="ticket_start">{{ trans('cruds.event.fields.ticket_start') }}</label>
                            <input class="form-control date" type="text" name="ticket_start" id="ticket_start" value="{{ old('ticket_start', $event->ticket_start) }}">
                            @if($errors->has('ticket_start'))
                                <span class="help-block" role="alert">{{ $errors->first('ticket_start') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.event.fields.ticket_start_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('ticket_end') ? 'has-error' : '' }}">
                            <label for="ticket_end">{{ trans('cruds.event.fields.ticket_end') }}</label>
                            <input class="form-control date" type="text" name="ticket_end" id="ticket_end" value="{{ old('ticket_end', $event->ticket_end) }}">
                            @if($errors->has('ticket_end'))
                                <span class="help-block" role="alert">{{ $errors->first('ticket_end') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.event.fields.ticket_end_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('featured_image') ? 'has-error' : '' }}">
                            <label for="featured_image">{{ trans('cruds.event.fields.featured_image') }}</label>
                            <div class="needsclick dropzone" id="featured_image-dropzone">
                            </div>
                            @if($errors->has('featured_image'))
                                <span class="help-block" role="alert">{{ $errors->first('featured_image') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.event.fields.featured_image_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('album') ? 'has-error' : '' }}">
                            <label for="album">{{ trans('cruds.event.fields.album') }}</label>
                            <div class="needsclick dropzone" id="album-dropzone">
                            </div>
                            @if($errors->has('album'))
                                <span class="help-block" role="alert">{{ $errors->first('album') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.event.fields.album_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('stage') ? 'has-error' : '' }}">
                            <label for="stage">{{ trans('cruds.event.fields.stage') }}</label>
                            <div class="needsclick dropzone" id="stage-dropzone">
                            </div>
                            @if($errors->has('stage'))
                                <span class="help-block" role="alert">{{ $errors->first('stage') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.event.fields.stage_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('category') ? 'has-error' : '' }}">
                            <label for="category_id">{{ trans('cruds.event.fields.category') }}</label>
                            <select class="form-control select2" name="category_id" id="category_id">
                                @foreach($categories as $id => $category)
                                    <option value="{{ $id }}" {{ (old('category_id') ? old('category_id') : $event->category->id ?? '') == $id ? 'selected' : '' }}>{{ $category }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('category'))
                                <span class="help-block" role="alert">{{ $errors->first('category') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.event.fields.category_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('publish') ? 'has-error' : '' }}">
                            <div>
                                <input type="hidden" name="publish" value="0">
                                <input type="checkbox" name="publish" id="publish" value="1" {{ $event->publish || old('publish', 0) === 1 ? 'checked' : '' }}>
                                <label for="publish" style="font-weight: 400">{{ trans('cruds.event.fields.publish') }}</label>
                            </div>
                            @if($errors->has('publish'))
                                <span class="help-block" role="alert">{{ $errors->first('publish') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.event.fields.publish_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                            <label for="city_id">{{ trans('cruds.event.fields.city') }}</label>
                            <select class="form-control select2" name="city_id" id="city_id">
                                @foreach($cities as $id => $city)
                                    <option value="{{ $id }}" {{ (old('city_id') ? old('city_id') : $event->city->id ?? '') == $id ? 'selected' : '' }}>{{ $city }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('city'))
                                <span class="help-block" role="alert">{{ $errors->first('city') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.event.fields.city_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('users') ? 'has-error' : '' }}">
                            <label for="users">{{ trans('cruds.event.fields.user') }}</label>
                        
                            <select class="form-control select2" name="user_id" id="users">
                                @foreach($users as $id => $user)
                                    <option value="{{ $id }}"  @if($event->user_id==$id)selected @endif>{{ $user }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('users'))
                                <span class="help-block" role="alert">{{ $errors->first('users') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.event.fields.user_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    Dropzone.options.featuredImageDropzone = {
    url: '{{ route('admin.events.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
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
</script>
<script>
    var uploadedAlbumMap = {}
Dropzone.options.albumDropzone = {
    url: '{{ route('admin.events.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
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
      $('form').append('<input type="hidden" name="album[]" value="' + response.name + '">')
      uploadedAlbumMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedAlbumMap[file.name]
      }
      $('form').find('input[name="album[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($event) && $event->album)
      var files = {!! json_encode($event->album) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="album[]" value="' + file.file_name + '">')
        }
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
    Dropzone.options.stageDropzone = {
    url: '{{ route('admin.events.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
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
      $('form').find('input[name="stage"]').remove()
      $('form').append('<input type="hidden" name="stage" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="stage"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($event) && $event->stage)
      var file = {!! json_encode($event->stage) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="stage" value="' + file.file_name + '">')
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
@endsection