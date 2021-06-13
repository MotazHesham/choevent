@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('cruds.user.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.users.update", [$user->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
                            @if($errors->has('name'))
                                <span class="help-block" role="alert">{{ $errors->first('name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                            <input class="form-control" type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
                            @if($errors->has('email'))
                                <span class="help-block" role="alert">{{ $errors->first('email') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                            <label class="required" for="password">{{ trans('cruds.user.fields.password') }}</label>
                            <input class="form-control" type="password" name="password" id="password">
                            @if($errors->has('password'))
                                <span class="help-block" role="alert">{{ $errors->first('password') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('roles') ? 'has-error' : '' }}">
                            <label class="required" for="roles">{{ trans('cruds.user.fields.roles') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="roles[]" id="roles" multiple required>
                                @foreach($roles as $id => $roles)
                                    <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || $user->roles->contains($id)) ? 'selected' : '' }}>{{ $roles }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('roles'))
                                <span class="help-block" role="alert">{{ $errors->first('roles') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.roles_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('mobile') ? 'has-error' : '' }}">
                            <label for="mobile">{{ trans('cruds.user.fields.mobile') }}</label>
                            <input class="form-control" type="text" name="mobile" id="mobile" value="{{ old('mobile', $user->mobile) }}">
                            @if($errors->has('mobile'))
                                <span class="help-block" role="alert">{{ $errors->first('mobile') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.mobile_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                            <label for="description">{{ trans('cruds.user.fields.description') }}</label>
                            <textarea class="form-control ckeditor" name="description" id="description">{!! old('description', $user->description) !!}</textarea>
                            @if($errors->has('description'))
                                <span class="help-block" role="alert">{{ $errors->first('description') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('age') ? 'has-error' : '' }}">
                            <label for="age">{{ trans('cruds.user.fields.age') }}</label>
                            <input class="form-control" type="number" name="age" id="age" value="{{ old('age', $user->age) }}" step="1">
                            @if($errors->has('age'))
                                <span class="help-block" role="alert">{{ $errors->first('age') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.age_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('sex') ? 'has-error' : '' }}">
                            <label>{{ trans('cruds.user.fields.sex') }}</label>
                            <select class="form-control" name="sex" id="sex">
                                <option value disabled {{ old('sex', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\User::SEX_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('sex', $user->sex) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('sex'))
                                <span class="help-block" role="alert">{{ $errors->first('sex') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.sex_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('avatar') ? 'has-error' : '' }}">
                            <label for="avatar">{{ trans('cruds.user.fields.avatar') }}</label>
                            <div class="needsclick dropzone" id="avatar-dropzone">
                            </div>
                            @if($errors->has('avatar'))
                                <span class="help-block" role="alert">{{ $errors->first('avatar') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.avatar_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('company_register') ? 'has-error' : '' }}">
                            <label for="company_register">{{ trans('cruds.user.fields.company_register') }}</label>
                            <input class="form-control" type="text" name="company_register" id="company_register" value="{{ old('company_register', $user->company_register) }}">
                            @if($errors->has('company_register'))
                                <span class="help-block" role="alert">{{ $errors->first('company_register') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.company_register_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('nationality') ? 'has-error' : '' }}">
                            <label for="nationality">{{ trans('cruds.user.fields.nationality') }}</label>
                            <input class="form-control" type="text" name="nationality" id="nationality" value="{{ old('nationality', $user->nationality) }}">
                            @if($errors->has('nationality'))
                                <span class="help-block" role="alert">{{ $errors->first('nationality') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.nationality_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('employee_name') ? 'has-error' : '' }}">
                            <label for="employee_name">{{ trans('cruds.user.fields.employee_name') }}</label>
                            <input class="form-control" type="text" name="employee_name" id="employee_name" value="{{ old('employee_name', $user->employee_name) }}">
                            @if($errors->has('employee_name'))
                                <span class="help-block" role="alert">{{ $errors->first('employee_name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.employee_name_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('identity_number') ? 'has-error' : '' }}">
                            <label for="identity_number">{{ trans('cruds.user.fields.identity_number') }}</label>
                            <input class="form-control" type="text" name="identity_number" id="identity_number" value="{{ old('identity_number', $user->identity_number) }}">
                            @if($errors->has('identity_number'))
                                <span class="help-block" role="alert">{{ $errors->first('identity_number') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.identity_number_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('active') ? 'has-error' : '' }}">
                            <div>
                                <input type="hidden" name="active" value="0">
                                <input type="checkbox" name="active" id="active" value="1" {{ $user->active || old('active', 0) === 1 ? 'checked' : '' }}>
                                <label for="active" style="font-weight: 400">{{ trans('cruds.user.fields.active') }}</label>
                            </div>
                            @if($errors->has('active'))
                                <span class="help-block" role="alert">{{ $errors->first('active') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.active_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('group') ? 'has-error' : '' }}">
                            <label>{{ trans('cruds.user.fields.group') }}</label>
                            <select class="form-control" name="group" id="group">
                                <option value disabled {{ old('group', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\User::GROUP_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('group', $user->group) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('group'))
                                <span class="help-block" role="alert">{{ $errors->first('group') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.group_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('services') ? 'has-error' : '' }}">
                            <label for="services">{{ trans('cruds.user.fields.service') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="services[]" id="services" multiple>
                                @foreach($services as $id => $service)
                                    <option value="{{ $id }}" {{ (in_array($id, old('services', [])) || $user->services->contains($id)) ? 'selected' : '' }}>{{ $service }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('services'))
                                <span class="help-block" role="alert">{{ $errors->first('services') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.service_helper') }}</span>
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
    Dropzone.options.avatarDropzone = {
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