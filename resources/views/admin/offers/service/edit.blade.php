@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.service_offer.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.offers.update", [$offer->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('order') ? 'has-error' : '' }}">
                            <label for="order_id">{{ trans('cruds.offer.fields.order') }}</label>
                            <select class="form-control select2" name="order_id" id="order_id">
                                @foreach($orders as $id => $order)
                                    <option value="{{ $id }}" {{ (old('order_id') ? old('order_id') : $offer->order->id ?? '') == $id ? 'selected' : '' }}>{{ $order }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('order'))
                                <span class="help-block" role="alert">{{ $errors->first('order') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.offer.fields.order_helper') }}</span>
                        </div>
                        
                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                            <label for="description">{{ trans('cruds.offer.fields.description') }}</label>
                            <textarea class="form-control ckeditor" name="description" id="description">{!! old('description', $offer->description) !!}</textarea>
                            @if($errors->has('description'))
                                <span class="help-block" role="alert">{{ $errors->first('description') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.offer.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('confirmed') ? 'has-error' : '' }}">
                            <div>
                                <input type="hidden" name="confirmed" value="0">
                                <input type="checkbox" name="confirmed" id="confirmed" value="1" {{ $offer->confirmed || old('confirmed', 0) === 1 ? 'checked' : '' }}>
                                <label for="confirmed" style="font-weight: 400">{{ trans('cruds.offer.fields.confirmed') }}</label>
                            </div>
                            @if($errors->has('confirmed'))
                                <span class="help-block" role="alert">{{ $errors->first('confirmed') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.offer.fields.confirmed_helper') }}</span>
                        </div>
                        
                        <div class="form-group {{ $errors->has('publish') ? 'has-error' : '' }}">
                            <div>
                                <input type="hidden" name="publish" value="0">
                                <input type="checkbox" name="publish" id="publish" value="1" {{ $offer->publish || old('publish', 0) === 1 ? 'checked' : '' }}>
                                <label for="publish" style="font-weight: 400">{{ trans('cruds.offer.fields.publish') }}</label>
                            </div>
                            @if($errors->has('publish'))
                                <span class="help-block" role="alert">{{ $errors->first('publish') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.offer.fields.publish_helper') }}</span>
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
                xhr.open('POST', '/admin/offers/ckmedia', true);
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
                data.append('crud_id', {{ $offer->id ?? 0 }});
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