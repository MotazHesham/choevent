@extends('website.layouts.main')
@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
<link rel='stylesheet' href="{{asset('css/custom_profile_'.app()->getLocale().'.css')}}">
<style>
    header{background: #fff;}
    .menu .trigger{color:#a6217b}
    .needsclick{
        border-radius: 30px;
        border: solid thin #ddd;
        margin-top: 10px;
    }
    select{
        padding:8px !important;
    }
    .accountdetails{
        border:none;
    }
    input , select ,textarea {
       border: 2px solid #e0e0e0  !important;
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
                        <i class="fas fa-long-arrow-alt-{{$arrow_direction}}"></i>&nbsp; {{ trans('website.menu.dashboard') }}
                </div>      
            </div>
        </div>
    </div>
</section>
<section class="profile bg_custom_1507727948742">
    <div class="container-fluid p-50">
        <div class="container-fluid display-table">
            @if(Session::has('msg'))
            <div class="alert alert-success">{{ Session::get('msg') }}</div>
            @endif
            <div class="row display-table-row">
                @include('website.partials.sidebar')
                <div class="col-md-10 col-sm-11 display-table-cell v-align" style="background: #FCFCFC">
                    <!--<button type="button" class="slide-toggle">Slide Toggle</button> -->
                     {{-- search part --}}
                    <div class="user-dashboard">
                        <form method="POST" action="{{ route("website.profile.update") }}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                        <div class="row">
                           <div class="col-md-12">
                                <h4>{{ trans('website.menu.personal_info') }}</h4>
                           </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="accountdetails"> {{ trans('website.register.name') }}</div>
                                <input type="text" class="form-control" name="name"  required  autofocus="" value="{{$user->name}}" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                @if($user->group!='user')
                                <div class="form-group">
                                    <div class="accountdetails"> {{ trans('website.register.company_register') }}</div>
                                    <input type="text" value="{{$user->company_register}}" class="form-control" name="company_register" placeholder=" {{ trans('website.register.company_register') }} " required autofocus="" />
                                </div>
                            @else
                            <div class="form-group {{ $errors->has('age') ? 'has-error' : '' }}">
                                <div class="accountdetails">  {{ trans('website.register.age') }}</div>
                                <input class="form-control" type="number" name="age" id="age" value="{{ old('age', $user->age) }}" step="1">
                            </div>
                            @endif
                            </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                            @if($user->group!='user')
                                <div class="form-group">
                                    <div class="accountdetails">  {{ trans('website.register.employee_name') }}</div>
                                <input type="text" class="form-control" value="{{$user->employee_name}}" name="employee_name" placeholder="{{ trans('website.register.employee_name') }}" required="" autofocus="" />
                                </div>
                                @else
                                <div class="form-group {{ $errors->has('sex') ? 'has-error' : '' }}">
                                    <div class="accountdetails"> {{ trans('website.register.sex') }}</div>
                                    <select class="form-control" name="sex" id="sex">
                                        <option value disabled {{ old('sex', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                        @foreach(App\Models\User::SEX_SELECT as $key => $label)
                                            <option value="{{ $key }}" {{ old('sex', $user->sex) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="accountdetails"> {{ trans('website.register.identity_number') }}</div>
                                <input type="text" class="form-control" value="{{$user->identity_number}}" name="identity_number" placeholder="{{ trans('website.register.identity_number') }}" required autofocus="" />
                                </div>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="accountdetails"> {{ trans('website.register.email') }}</div>
                                    <input type="text" class="form-control" value="{{$user->email}}" name="email" placeholder="{{ trans('website.register.email') }}" required autofocus="" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="accountdetails"> {{ trans('website.register.mobile') }}</div>
                                    <input type="number" class="form-control" value="{{$user->mobile}}" name="mobile" placeholder="{{ trans('website.register.mobile') }}" required  autofocus="" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="accountdetails"> {{ trans('website.register.password') }}</div>
                                    <input type="password" class="form-control"  name="password" placeholder="{{ trans('website.register.password') }}" autofocus="" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="accountdetails"> {{ trans('website.register.password_confirmation') }}</div>
                                    <input type="password" class="form-control"  name="password_confirmation" placeholder="{{ trans('website.register.password_confirmation') }}"   autofocus="" />
                                </div>
                            </div>
                        </div>
                       <div class="row">
                        
                            <div class="col-md-6">
                                @if($user->group!='user')
                                <div class="form-group">
                                    <div class="accountdetails"> {{ trans('website.register.logo') }}  </div>
                                    <div class="needsclick dropzone" id="avatar-dropzone">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="accountdetails">{{ trans('website.register.about_company') }}</div>
                                    <textarea class="form-control ckeditor" rows="6" name="description" id="description">{!!$user->description!!}</textarea>
                                </div>
                             @else
                            <div class="form-group {{ $errors->has('nationality') ? 'has-error' : '' }}">
                                <div class="accountdetails">{{ trans('website.register.nationality') }}</div>
                                <select class="form-control" name="nationality" id="nationality">
                                    <option value disabled {{ old('nationality', null) === null ? 'selected' : '' }}>{{ trans('website.register.nationality') }}</option>
                                    @foreach(App\Models\User::NATIONALITY_SELECT as $key => $label)
                                        <option value="{{ $key }}" {{ old('nationality', $user->nationality) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endif
                        </div>
                    </div>
                    @if($user->group=='provider')
                    <div class="row">
                        <div class="col-md-10">
                            <div class="accountdetails">{{ trans('website.register.provided_services') }}</div>
                            <select class="form-control select2" name="services[]" id="services" multiple>
                                @foreach($services as $id => $service)
                                    <option value="{{ $id }}" {{ (in_array($id, old('services', [])) || $user->services->contains($id)) ? 'selected' : '' }}>{{ $service }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endif
                        <button class="btn btn-lg btn-primary " type="submit">{{ trans('website.global.save') }}</button>   
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
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
                xhr.open('POST', '/admin/users/ckmedia', true);
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
                data.append('crud_id', {{ $user->id ?? 0 }});
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
<script>
    Dropzone.options.avatarDropzone = {
    url: '{{ route('website.users.storeMedia') }}',
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
      $('form').find('input[name="avatar"]').remove()
      $('form').append('<input type="hidden" name="avatar" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="avatar"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($user) && $user->avatar)
      var file = {!! json_encode($user->avatar) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="avatar" value="' + file.file_name + '">')
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