@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.sponsoring_offer.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.offers.index',['type'=>'sponsoring']) }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.offer.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $offer->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.offer.fields.order') }}
                                    </th>
                                    <td>
                                        {{ $offer->order->name ?? '' }}
                                    </td>
                                </tr>
                               
                                <tr>
                                    <th>
                                        {{ trans('cruds.offer.fields.description') }}
                                    </th>
                                    <td>
                                        {!! $offer->description !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.offer.fields.confirmed') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $offer->confirmed ? 'checked' : '' }}>
                                    </td>
                                </tr>
                               
                                <tr>
                                    <th>
                                        {{ trans('cruds.offer.fields.publish') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $offer->publish ? 'checked' : '' }}>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.offers.index',['type'=>'sponsoring']) }}">
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