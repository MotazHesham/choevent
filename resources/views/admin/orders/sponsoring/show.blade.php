@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                   
                    {{ trans('global.show') }} {{ trans('cruds.sponsoring_order.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.orders.index',['type'=>'sponsoring']) }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.order.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $order->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.order.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $order->name }}
                                    </td>
                                </tr>
                               
                                <tr>
                                    <th>
                                        {{ trans('cruds.order.fields.event') }}
                                    </th>
                                    <td>
                                        {{ $order->event->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.order.fields.description') }}
                                    </th>
                                    <td>
                                        {!! $order->description !!}
                                    </td>
                                </tr>
                                
                               
                                <tr>
                                    <th>
                                        {{ trans('cruds.order.fields.sponser') }}
                                    </th>
                                    <td>
                                        {{ $order->sponser->name ?? '' }}
                                    </td>
                                </tr>
                               
                               
                                <tr>
                                    <th>
                                        {{ trans('cruds.order.fields.publish') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $order->publish ? 'checked' : '' }}>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.orders.index',['type'=>'sponsoring']) }}">
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