@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.configration.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.configrations.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('item') ? 'has-error' : '' }}">
                            <label for="item">{{ trans('cruds.configration.fields.item') }}</label>
                            <input class="form-control" type="text" name="item" id="item" value="{{ old('item', '') }}">
                            @if($errors->has('item'))
                                <span class="help-block" role="alert">{{ $errors->first('item') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.configration.fields.item_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('value') ? 'has-error' : '' }}">
                            <label for="value">{{ trans('cruds.configration.fields.value') }}</label>
                            <input class="form-control" type="text" name="value" id="value" value="{{ old('value', '') }}">
                            @if($errors->has('value'))
                                <span class="help-block" role="alert">{{ $errors->first('value') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.configration.fields.value_helper') }}</span>
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