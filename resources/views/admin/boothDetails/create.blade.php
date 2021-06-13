@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('cruds.boothDetail.title_singular') }}
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route("admin.booth-details.store") }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('order') ? 'has-error' : '' }}">
                            <label for="order">{{ trans('cruds.boothDetail.fields.order') }}</label>
                            <input class="form-control" type="number" name="order" id="order" value="{{ old('order', '') }}" step="1">
                            @if($errors->has('order'))
                                <span class="help-block" role="alert">{{ $errors->first('order') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.boothDetail.fields.order_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('activity') ? 'has-error' : '' }}">
                            <label>{{ trans('cruds.boothDetail.fields.activity') }}</label>
                            <select class="form-control" name="activity" id="activity">
                                <option value disabled {{ old('activity', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\BoothDetail::ACTIVITY_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('activity', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('activity'))
                                <span class="help-block" role="alert">{{ $errors->first('activity') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.boothDetail.fields.activity_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('length') ? 'has-error' : '' }}">
                            <label for="length">{{ trans('cruds.boothDetail.fields.length') }}</label>
                            <input class="form-control" type="number" name="length" id="length" value="{{ old('length', '') }}" step="0.01">
                            @if($errors->has('length'))
                                <span class="help-block" role="alert">{{ $errors->first('length') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.boothDetail.fields.length_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('width') ? 'has-error' : '' }}">
                            <label for="width">{{ trans('cruds.boothDetail.fields.width') }}</label>
                            <input class="form-control" type="number" name="width" id="width" value="{{ old('width', '') }}" step="0.01">
                            @if($errors->has('width'))
                                <span class="help-block" role="alert">{{ $errors->first('width') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.boothDetail.fields.width_helper') }}</span>
                        </div>
                        <div class="form-group {{ $errors->has('booth') ? 'has-error' : '' }}">
                            <label for="booth_id">{{ trans('cruds.boothDetail.fields.booth') }}</label>
                            <select class="form-control select2" name="booth_id" id="booth_id">
                                @foreach($booths as $id => $booth)
                                    <option value="{{ $id }}" {{ old('booth_id') == $id ? 'selected' : '' }}>{{ $booth }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('booth'))
                                <span class="help-block" role="alert">{{ $errors->first('booth') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.boothDetail.fields.booth_helper') }}</span>
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