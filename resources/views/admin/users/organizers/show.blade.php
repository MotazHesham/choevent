@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.user.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.users.index',['group'=>'organizer']) }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $user->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $user->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.email') }}
                                    </th>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.email_verified_at') }}
                                    </th>
                                    <td>
                                        {{ $user->email_verified_at }}
                                    </td>
                                </tr>
                               
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.mobile') }}
                                    </th>
                                    <td>
                                        {{ $user->mobile }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.description') }}
                                    </th>
                                    <td>
                                        {!! $user->description !!}
                                    </td>
                                </tr>
                               
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.avatar') }}
                                    </th>
                                    <td>
                                        @if($user->avatar)
                                            <a href="{{ $user->avatar->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $user->avatar->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.company_register') }}
                                    </th>
                                    <td>
                                        {{ $user->company_register }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.company_register_image') }}
                                    </th>
                                    <td>
                                        @if($user->company_register_image)
                                            <a href="{{ $user->company_register_image->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $user->company_register_image->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                               
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.employee_name') }}
                                    </th>
                                    <td>
                                        {{ $user->employee_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.employee_identity_image') }}
                                    </th>
                                    <td>
                                        @if($user->employee_identity_image)
                                            <a href="{{ $user->employee_identity_image->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $user->employee_identity_image->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.active') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $user->active ? 'checked' : '' }}>
                                    </td>
                                </tr>
                               
                               
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.users.index',['group'=>'organizer']) }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection