@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.service_order.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.orders.update", [$order->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">{{ trans('cruds.order.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $order->name) }}">
                            @if($errors->has('name'))
                                <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.order.fields.name_helper') }}</span>
                        </div>
                       
                        <div class="form-group {{ $errors->has('event') ? 'has-error' : '' }}">
                            <label for="event_id">{{ trans('cruds.order.fields.event') }}</label>
                            <select class="form-control select2" name="event_id" id="event_id">
                                @foreach($events as $id => $event)
                                    <option value="{{ $id }}" {{ (old('event_id') ? old('event_id') : $order->event->id ?? '') == $id ? 'selected' : '' }}>{{ $event }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('event'))
                                <span class="help-block" role="alert">{{ $errors->first('event') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.order.fields.event_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                            <label for="description">{{ trans('cruds.order.fields.description') }}</label>
                            <textarea class="form-control ckeditor" name="description" id="description">{!! old('description', $order->description) !!}</textarea>
                            @if($errors->has('description'))
                                <span class="help-block" role="alert">{{ $errors->first('description') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.order.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('category') ? 'has-error' : '' }}">
                            <label for="category_id">{{ trans('cruds.order.fields.category') }}</label>
                            <select class="form-control select2" name="category_id" id="category_id">
                                @foreach($categories as $id => $category)
                                    <option value="{{ $id }}" {{ (old('category_id') ? old('category_id') : $order->category->id ?? '') == $id ? 'selected' : '' }}>{{ $category }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('category'))
                                <span class="help-block" role="alert">{{ $errors->first('category') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.order.fields.category_helper') }}</span>
                        </div>
                       <div class="form-group {{ $errors->has('days') ? 'has-error' : '' }}">
                            <label for="days">{{ trans('cruds.order.fields.days') }}</label>
                            <input class="form-control" type="number" name="days" id="days" value="{{ old('days', $order->days) }}" step="1">
                            @if($errors->has('days'))
                                <span class="help-block" role="alert">{{ $errors->first('days') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.order.fields.days_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('setup_date') ? 'has-error' : '' }}">
                            <label for="setup_date">{{ trans('cruds.order.fields.setup_date') }}</label>
                            <input class="form-control date" type="text" name="setup_date" id="setup_date" value="{{ old('setup_date', $order->setup_date) }}">
                            @if($errors->has('setup_date'))
                                <span class="help-block" role="alert">{{ $errors->first('setup_date') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.order.fields.setup_date_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('publish') ? 'has-error' : '' }}">
                            <div>
                                <input type="hidden" name="publish" value="0">
                                <input type="checkbox" name="publish" id="publish" value="1" {{ $order->publish || old('publish', 0) === 1 ? 'checked' : '' }}>
                                <label for="publish" style="font-weight: 400">{{ trans('cruds.order.fields.publish') }}</label>
                            </div>
                            @if($errors->has('publish'))
                                <span class="help-block" role="alert">{{ $errors->first('publish') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.order.fields.publish_helper') }}</span>
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
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/admin/orders/ckmedia', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', {{ $order->id ?? 0 }});
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

@endsection