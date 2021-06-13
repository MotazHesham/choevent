@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.event.title') }}
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.events.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.event.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $event->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.event.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $event->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.event.fields.address') }}
                                    </th>
                                    <td>
                                        {{ $event->address }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.event.fields.lat') }}
                                    </th>
                                    <td>
                                        {{ $event->lat }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.event.fields.lng') }}
                                    </th>
                                    <td>
                                        {{ $event->lng }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.event.fields.description') }}
                                    </th>
                                    <td>
                                        {{ $event->description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.event.fields.start_at') }}
                                    </th>
                                    <td>
                                        {{ $event->start_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.event.fields.end_at') }}
                                    </th>
                                    <td>
                                        {{ $event->end_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.event.fields.age_max') }}
                                    </th>
                                    <td>
                                        {{ $event->age_max }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.event.fields.age_min') }}
                                    </th>
                                    <td>
                                        {{ $event->age_min }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.event.fields.nationality') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Event::NATIONALITY_SELECT[$event->nationality] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.event.fields.sex') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Event::SEX_SELECT[$event->sex] ?? '' }}
                                    </td>
                                </tr>
                              
                                <tr>
                                    <th>
                                        {{ trans('cruds.event.fields.featured_image') }}
                                    </th>
                                    <td>
                                        @if($event->featured_image)
                                            <a href="{{ $event->featured_image->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $event->featured_image->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.event.fields.album') }}
                                    </th>
                                    <td>
                                        @foreach($event->album as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $media->getUrl('thumb') }}">
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.event.fields.stage') }}
                                    </th>
                                    <td>
                                        @if($event->stage)
                                            <a href="{{ $event->stage->getUrl() }}" target="_blank" style="display: inline-block">
                                                <img src="{{ $event->stage->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.event.fields.category') }}
                                    </th>
                                    <td>
                                        {{ $event->category->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.event.fields.publish') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $event->publish ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.event.fields.city') }}
                                    </th>
                                    <td>
                                        {{ $event->city->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                       منظم الفعالية
                                    </th>
                                    <td>
                                        
                                            <span class="label label-info">{{ $event->user->name }}</span>
                                       
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('admin.events.index') }}">
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