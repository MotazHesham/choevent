@extends('layouts.admin')
@section('content')
<div class="content">
    {{-- @can('consultation_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.consultations.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.consultation.title_singular') }}
                </a>
            </div>
        </div>
    @endcan --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.consultation.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Consultation">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.consultation.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.consultation.fields.email') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.consultation.fields.mobile') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.consultation.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.consultation.fields.status') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($consultations as $key => $consultation)
                                    <tr data-entry-id="{{ $consultation->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $consultation->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $consultation->email ?? '' }}
                                        </td>
                                        <td>
                                            {{ $consultation->mobile ?? '' }}
                                        </td>
                                        <td>
                                            {{ $consultation->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\Consultation::STATUS_SELECT[$consultation->status] ?? '' }}
                                        </td>
                                        <td>
                                            @can('consultation_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.consultations.show', $consultation->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('consultation_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.consultations.edit', $consultation->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('consultation_delete')
                                                <form action="{{ route('admin.consultations.destroy', $consultation->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('consultation_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.consultations.massDestroy') }}",
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
  let table = $('.datatable-Consultation:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection