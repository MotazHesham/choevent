@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.boothDetail.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.booth-details.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.boothDetail.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $boothDetail->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.boothDetail.fields.order') }}
                                    </th>
                                    <td>
                                        {{ $boothDetail->order }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.boothDetail.fields.activity') }}
                                    </th>
                                    <td>
                                        {{ App\Models\BoothDetail::ACTIVITY_SELECT[$boothDetail->activity] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.boothDetail.fields.length') }}
                                    </th>
                                    <td>
                                        {{ $boothDetail->length }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.boothDetail.fields.width') }}
                                    </th>
                                    <td>
                                        {{ $boothDetail->width }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.boothDetail.fields.booth') }}
                                    </th>
                                    <td>
                                        {{ $boothDetail->booth->name ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.booth-details.index') }}">
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