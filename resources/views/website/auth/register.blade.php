@extends('website.layouts.main')
@section('styles')
<link rel="stylesheet" href="sweetalert2.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
<style>
    header{background: #fff;}
    .menu .trigger{color:#a6217b}
    .needsclick{
        border-radius: 30px;
        border: solid thin #ddd;
        margin-top: 10px;
    }
select{
    padding:7px !important;
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
                        <i class="fas fa-long-arrow-alt-{{ $arrow_direction}}"></i>&nbsp; {{trans('website.header.register') }}
                </div>      
            </div>
        </div>
    </div>
</section>
<section class="login bg_custom_1507727948742 reg" >
    <div class="container p-50" >
        <div class="tabs ">
            <input type="radio" name="tab" id="tab1" checked="checked">
            <label for="tab1">{{ trans('website.menu.sponsor') }}</label>
            <input type="radio" name="tab" id="tab2">
            <label for="tab2">{{ trans('website.menu.organizer') }}</label>
            <input type="radio" name="tab" id="tab3">
            <label for="tab3">{{ trans('website.menu.provider') }}</label>
            <input type="radio" name="tab" id="tab4">
            <label for="tab4">{{ trans('website.menu.user') }}</label>
            <div class="tab-content-wrapper">
                <div id="tab-content-1" class="tab-content">
                    <div class="col-md-12">
                    <form method="POST" action="{{ route("website.register") }}" enctype="multipart/form-data" class="register-form">
                        @csrf
                        <input type="hidden" name="group" value="sponsor">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>	{{ trans('website.register.company_name') }} </label>
                                    <input type="text" class="form-control" name="name" placeholder="{{ trans('website.register.company_name') }} " required autofocus="" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>	 {{ trans('website.register.company_register') }}  </label>
                                    <input type="text" class="form-control" name="company_register" placeholder=" {{ trans('website.register.company_register') }} " required autofocus="" />
                                </div> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>	{{ trans('website.register.employee_name') }}  </label>
                                    <input type="text" class="form-control" name="employee_name" placeholder="{{ trans('website.register.employee_name') }} " required="" autofocus="" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ trans('website.register.identity_number') }}  </label>
                                    <input type="text" class="form-control" name="identity_number" placeholder="{{ trans('website.register.identity_number') }}" required autofocus="" />
                                </div> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>	{{ trans('website.register.email') }} </label>
                                    <input type="text" class="form-control" name="email" placeholder="{{ trans('website.register.email') }}" required autofocus="" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>	{{ trans('website.register.mobile') }}   </label>
                                    <input type="text" class="form-control" name="mobile" placeholder="	{{ trans('website.register.mobile') }}" required  autofocus="" />
                                </div> 
                            </div>
                           
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                    <label class="required" for="password">{{ trans('website.register.password') }}</label>
                                    <input class="form-control" type="password" name="password"  required>
                                    @if($errors->has('password'))
                                        <span class="help-block" role="alert">{{ $errors->first('password') }}</span>
                                    @endif
                                   
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                                    <label class="required" for="password_confirmation">{{ trans('website.register.password_confirmation') }}</label>
                                    <input class="form-control" type="password" name="password_confirmation"  required>
                                    @if($errors->has('password_confirmation'))
                                        <span class="help-block" role="alert">{{ $errors->first('password_confirmation') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('avatar') ? 'has-error' : '' }}">
                                    <label for="avatar">{{ trans('website.register.logo') }}</label>
                                    <div class="needsclick dropzone" id="avatar-dropzone">
                                    </div>
                                    @if($errors->has('avatar'))
                                        <span class="help-block" role="alert">{{ $errors->first('avatar') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.user.fields.avatar_helper') }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                                    <label for="description">{{ trans('website.register.about_company') }}</label>
                                    <textarea class="form-control ckeditor" rows="6" name="description" >{!! old('description') !!}</textarea>
                                    @if($errors->has('description'))
                                        <span class="help-block" role="alert">{{ $errors->first('description') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.user.fields.description_helper') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4 mb-2">
                            <div class="col-md-1 text-center">
                                <input type="checkbox" required>
                            </div>
                            <div class="col-md-3">
                                <label > 
                                    <a href="{{url('conditions')}}">
                                        {{ trans('website.register.agree_on_conditions') }}
                                    </a>
                                </label>
                            </div>
                           
                        </div>
                       <button class="btn btn-lg btn-primary" type="submit">{{ trans('website.register.register') }}</button> 
                    </form>  
                    </div>
                </div>
                <div id="tab-content-2" class="tab-content">
                    <div class="col-md-12">
                        <form method="POST" action="{{ route("website.register") }}" enctype="multipart/form-data" class="register-form">
                            @csrf
                            <input type="hidden" name="group" value="organizer">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>	{{ trans('website.register.company_name') }} </label>
                                    <input type="text" class="form-control" name="name" placeholder="{{ trans('website.register.company_name') }}" required autofocus="" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>	{{ trans('website.register.company_register') }}  </label>
                                    <input type="text" class="form-control" name="company_register" placeholder=" {{ trans('website.register.company_register') }} " required autofocus="" />
                                </div> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ trans('website.register.employee_name') }}  </label>
                                    <input type="text" class="form-control" name="employee_name" placeholder="{{ trans('website.register.employee_name') }}" required="" autofocus="" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ trans('website.register.identity_number') }}  </label>
                                    <input type="text" class="form-control" name="identity_number" placeholder="{{ trans('website.register.identity_number') }}" required autofocus="" />
                                </div> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>	{{ trans('website.register.email') }} </label>
                                    <input type="text" class="form-control" name="email" placeholder="	{{ trans('website.register.email') }}" required autofocus="" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>		{{ trans('website.register.mobile') }}  </label>
                                    <input type="text" class="form-control" name="mobile" placeholder="{{ trans('website.register.mobile') }}" required  autofocus="" />
                                </div> 
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                    <label class="required" for="password">{{ trans('website.register.password') }}</label>
                                    <input class="form-control" type="password" name="password"  required>
                                    @if($errors->has('password'))
                                        <span class="help-block" role="alert">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                                    <label class="required" for="password_confirmation">{{ trans('website.register.password_confirmation') }}</label>
                                    <input class="form-control" type="password" name="password_confirmation"  required>
                                    @if($errors->has('password_confirmation'))
                                        <span class="help-block" role="alert">{{ $errors->first('password_confirmation') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('avatar') ? 'has-error' : '' }}">
                                    <label for="avatar">{{ trans('website.register.logo') }}</label>
                                    <div class="needsclick dropzone" id="avatar-dropzone">
                                    </div>
                                    @if($errors->has('avatar'))
                                        <span class="help-block" role="alert">{{ $errors->first('avatar') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.user.fields.avatar_helper') }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                                    <label for="description">{{ trans('website.register.about_company') }}</label>
                                    <textarea class="form-control ckeditor" rows="6" name="description" >{!! old('description') !!}</textarea>
                                    @if($errors->has('description'))
                                        <span class="help-block" role="alert">{{ $errors->first('description') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.user.fields.description_helper') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4 mb-2">
                            <div class="col-md-1 text-center">
                                <input type="checkbox" required>
                            </div>
                            <div class="col-md-3">
                                <label > 
                                    <a href="{{url('conditions')}}">
                                        {{ trans('website.register.agree_on_conditions') }}
                                    </a>
                                </label>
                            </div>
                           
                        </div>
                        <button class="btn btn-lg btn-primary" type="submit">{{ trans('website.register.register') }}</button>   
                        </form>
                    </div>
                </div>
                <div id="tab-content-3" class="tab-content">
                    <div class="col-md-12">
                        <form method="POST" action="{{ route("website.register") }}" enctype="multipart/form-data" class="register-form">
                            @csrf
                            <input type="hidden" name="group" value="provider">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>	{{ trans('website.register.company_register') }} </label>
                                    <input type="text" class="form-control" name="name" placeholder="{{ trans('website.register.company_name') }}" required autofocus="" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>	{{ trans('website.register.company_register') }}  </label>
                                    <input type="text" class="form-control" name="company_register" placeholder=" {{ trans('website.register.company_register') }} " required autofocus="" />
                                </div> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>	{{ trans('website.register.employee_name') }}  </label>
                                    <input type="text" class="form-control" name="employee_name" placeholder="{{ trans('website.register.employee_name') }}" required="" autofocus="" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ trans('website.register.identity_number') }}  </label>
                                    <input type="text" class="form-control" name="identity_number" placeholder="{{ trans('website.register.identity_number') }}" required autofocus="" />
                                </div> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>	{{ trans('website.register.email') }} </label>
                                    <input type="text" class="form-control" name="email" placeholder="{{ trans('website.register.email') }}" required autofocus="" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>		{{ trans('website.register.mobile') }}   </label>
                                    <input type="text" class="form-control" name="mobile" placeholder="	{{ trans('website.register.mobile') }}" required  autofocus="" />
                                </div> 
                            </div>
                           
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                    <label class="required" for="password">	{{ trans('website.register.password') }}</label>
                                    <input class="form-control" type="password" name="password"  required>
                                    @if($errors->has('password'))
                                        <span class="help-block" role="alert">{{ $errors->first('password') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                                    <label class="required" for="password_confirmation">{{ trans('website.register.password_confirmation') }}</label>
                                    <input class="form-control" type="password" name="password_confirmation"  required>
                                    @if($errors->has('password_confirmation'))
                                        <span class="help-block" role="alert">{{ $errors->first('password_confirmation') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                       <div class="row">
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('services') ? 'has-error' : '' }}">
                                    <label for="services">{{ trans('website.register.provided_services') }}</label>
                                    <select class="form-control" name="services[]" id="services" multiple>
                                        @foreach($services as $id => $service)
                                            <option value="{{ $id }}" {{ in_array($id, old('services', [])) ? 'selected' : '' }}>{{ $service }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('services'))
                                        <span class="help-block" role="alert">{{ $errors->first('services') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('avatar') ? 'has-error' : '' }}">
                                    <label for="avatar">{{ trans('website.register.logo') }}</label>
                                    <div class="needsclick dropzone" id="avatar-dropzone">
                                    </div>
                                    @if($errors->has('avatar'))
                                        <span class="help-block" role="alert">{{ $errors->first('avatar') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.user.fields.avatar_helper') }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                                    <label for="description">{{ trans('website.register.about_company') }}</label>
                                    <textarea class="form-control ckeditor" rows="6" name="description" >{!! old('description') !!}</textarea>
                                    @if($errors->has('description'))
                                        <span class="help-block" role="alert">{{ $errors->first('description') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.user.fields.description_helper') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4 mb-2">
                            <div class="col-md-1 text-center">
                                <input type="checkbox" required>
                            </div>
                            <div class="col-md-3">
                                <label > 
                                    <a href="{{url('conditions')}}">
                                        {{ trans('website.register.agree_on_conditions') }}
                                    </a>
                                </label>
                            </div>
                           
                        </div>
                        <div class="clear"></div>
                        <button class="btn btn-lg btn-primary " type="submit">{{ trans('website.register.register') }}</button>
                    </form>   
                    </div>
                </div>
                <div id="tab-content-4" class="tab-content">
                    <div class="col-md-12">
                        <form method="POST" action="{{ route("website.register") }}" enctype="multipart/form-data" class="register-form" >
                            @csrf
                            <input type="hidden" name="group" value="user">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>	الاسم </label>
                                    <input type="text" class="form-control" name="name" placeholder="الاسم" required="" autofocus="" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>	{{ trans('website.register.email') }}  </label>
                                    <input type="text" class="form-control" name="email" placeholder=" {{ trans('website.register.email') }} " required="" autofocus="" />
                                </div> 
                            </div>
                           
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>	{{ trans('website.register.mobile') }} </label>
                                    <input type="text" class="form-control" name="mobile" placeholder="	{{ trans('website.register.mobile') }} " required="" autofocus="" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="gender">	{{ trans('website.register.sex') }}  </label>
                                    <select class="form-control" id="gender" name="sex" autofocus="">
                                        <option value=""> {{ trans('website.register.sex') }}</option>
                                        <option value="male">ذكر</option>
                                        <option value="female">أنثى</option>
                                    </select>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('age') ? 'has-error' : '' }}">
                                    <label for="age">{{ trans('website.register.age') }}</label>
                                    <input class="form-control" type="number" name="age" id="age" value="{{ old('age', '') }}" step="1">
                                    @if($errors->has('age'))
                                        <span class="help-block" role="alert">{{ $errors->first('age') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.user.fields.age_helper') }}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{ trans('website.register.identity_number') }}  </label>
                                    <input type="text" class="form-control" name="identity_number" placeholder="رقم الهوية" required autofocus="" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label  for="nationality">	{{ trans('website.register.nationality') }} </label>
                                    <select name="nationality" id="nationality" class="form-control">
                                        <option value="">{{ trans('website.register.nationality') }}</option>
                                        <option value="saudi">السعودية</option>
                                        <option value="other">أخرى</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                        <label class="required" for="password">{{ trans('website.register.password') }}</label>
                                        <input class="form-control" type="password" name="password"  required>
                                        @if($errors->has('password'))
                                            <span class="help-block" role="alert">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                                        <label class="required" for="password_confirmation">{{ trans('website.register.password_confirmation') }}</label>
                                        <input class="form-control" type="password" name="password_confirmation"  required>
                                        @if($errors->has('password_confirmation'))
                                            <span class="help-block" role="alert">{{ $errors->first('password_confirmation') }}</span>
                                        @endif
                                    </div>
                                </div>
                        </div>
                        <div class="row mt-4 mb-2">
                            <div class="col-md-1 text-center">
                                <input type="checkbox" required>
                            </div>
                            <div class="col-md-3">
                                <label > 
                                    <a href="{{url('conditions')}}">
                                        {{ trans('website.register.agree_on_conditions') }}
                                    </a>
                                </label>
                            </div>
                           
                        </div>
                        {{-- <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('avatar') ? 'has-error' : '' }}">
                                    <label for="avatar">صورة البروفايل</label>
                                    <div class="needsclick dropzone" id="avatar-dropzone">
                                    </div>
                                    @if($errors->has('avatar'))
                                        <span class="help-block" role="alert">{{ $errors->first('avatar') }}</span>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.user.fields.avatar_helper') }}</span>
                                </div>
                            </div>
                            
                        </div> --}}
                            <button class="btn btn-lg btn-primary " type="submit">{{ trans('website.register.register') }}</button> 
                        </form>  
                    </div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</section>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="sweetalert2.min.js"></script>
<script>
    $(".btn-primary").click(function(e){
        let frm=$( this ).parent().get( 0);
        e.preventDefault();
        $.ajax({
        url: "{{route('website.register.validate')}}",
        method: "post",
        dataType: 'json',
        data: $(frm).serialize(),
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        success: function (response) {
            console.log(response);
			if(response.error !=0){
                Swal.fire({
                icon: 'error',
                title: "{{trans('website.global.something_wrong') }}...",
                text: response.message,
                })
		    }else{
                $(frm).submit(); 
            }
		}
    });
        

    });
    	
</script>
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

//   var allEditors = document.querySelectorAll('.ckeditor');
//   for (var i = 0; i < allEditors.length; ++i) {
//     ClassicEditor.create(
//       allEditors[i], {
//         extraPlugins: [SimpleUploadAdapter]
//       }
//     );
//   }
});
</script>

<script>
    Dropzone.options.avatarDropzone = {
    url: '{{ route('website.users.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    dictDefaultMessage:"{{trans('website.global.upload_photo') }}",
    dictRemoveFile:"{{trans('website.global.delete_photo') }}",
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
<script>
    Dropzone.options.companyRegisterImageDropzone = {
    url: '{{ route('admin.users.storeMedia') }}',
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
      $('form').find('input[name="company_register_image"]').remove()
      $('form').append('<input type="hidden" name="company_register_image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="company_register_image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($user) && $user->company_register_image)
      var file = {!! json_encode($user->company_register_image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="company_register_image" value="' + file.file_name + '">')
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
    Dropzone.options.employeeIdentityImageDropzone = {
    url: '{{ route('admin.users.storeMedia') }}',
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
      $('form').find('input[name="employee_identity_image"]').remove()
      $('form').append('<input type="hidden" name="employee_identity_image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="employee_identity_image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($user) && $user->employee_identity_image)
      var file = {!! json_encode($user->employee_identity_image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="employee_identity_image" value="' + file.file_name + '">')
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