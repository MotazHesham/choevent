@extends('layouts.admin')
@section('content')
<div class="content">
    @can('offer_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.offers.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.offer.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.offer.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Offer">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.offer.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.offer.fields.order') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.offer.fields.service_provider') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.offer.fields.confirmed') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.offer.fields.sponser') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.offer.fields.publish') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($offers as $key => $offer)
                                    <tr data-entry-id="{{ $offer->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $offer->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $offer->order->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $offer->service_provider->name ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $offer->confirmed ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $offer->confirmed ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            {{ $offer->sponser->name ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $offer->publish ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $offer->publish ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            @can('offer_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.offers.show', $offer->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('offer_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.offers.edit', $offer->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('offer_delete')
                                                <form action="{{ route('admin.offers.destroy', $offer->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('offer_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.offers.massDestroy') }}",
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
  let table = $('.datatable-Offer:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection