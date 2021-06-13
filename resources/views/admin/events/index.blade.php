@extends('layouts.admin')
@section('content')
<div class="content">
    {{-- @can('event_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.events.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.event.title_singular') }}
                </a>
            </div>
        </div>
    @endcan --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.event.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Event">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.event.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.event.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.event.fields.city') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.event.fields.address') }}
                                    </th>
                                   
                                    <th>
                                        {{ trans('cruds.event.fields.start_at') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.event.fields.end_at') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.event.fields.featured_image') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.event.fields.category') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.event.fields.publish') }}
                                    </th>
                                  
                                    <th>
                                        {{ trans('cruds.event.fields.user') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($events as $key => $event)
                                    <tr data-entry-id="{{ $event->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $event->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $event->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $event->city->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $event->address ?? '' }}
                                        </td>
                                       
                                        <td>
                                            {{ $event->start_at ?? '' }}
                                        </td>
                                        <td>
                                            {{ $event->end_at ?? '' }}
                                        </td>
                                      
                                        <td>
                                            @if($event->featured_image)
                                                <a href="{{ $event->featured_image->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $event->featured_image->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                        
                                       
                                        <td>
                                            {{ $event->category->name ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $event->publish ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $event->publish ? 'checked' : '' }}>
                                        </td>
                                       
                                        <td>
                                            
                                                <span class="label label-info label-many">{{ $event->user->name }}</span>
                                           
                                        </td>
                                        <td>
                                            @can('event_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.events.show', $event->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('event_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.events.edit', $event->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                                @if($event->publish==1)
                                                <a class="btn btn-xs btn-warning" href="{{ route('admin.events.suspend', $event->id) }}">
                                                   تعليق
                                                </a>
                                                @else
                                                <a class="btn btn-xs btn-success" href="{{ route('admin.events.activate', $event->id) }}">
                                                    تفعيل
                                                </a>
                                                @endif
                                            @endcan

                                            @can('event_delete')
                                                <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan
                                            

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('event_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.events.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Event:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection