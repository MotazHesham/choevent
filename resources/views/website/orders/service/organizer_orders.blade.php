@extends('website.layouts.main')
@section('styles')
<link rel='stylesheet' href="{{asset('css/custom_profile_'.app()->getLocale().'.css')}}">
<style>
    header{background: #fff;}
    .menu .trigger{color:#a6217b}
</style>
@endsection
@section('content')
@include('website.partials.header-2')
<section class="profile bg_custom_1507727948742">
    <div class="container-fluid p-50">
        <div class="container-fluid display-table">
            <div class="row display-table-row">
                @include('website.partials.sidebar')
                <div class="col-md-10 col-sm-11 display-table-cell v-align">
                    <div class="user-dashboard">
                        <div style="margin-bottom: 10px;" class="row">
                            <div class="col-lg-12">
                            <a class="btn btn-success" href="{{route('website.orders.create',['type'=>'service'])}}">
                                   طلب خدمة جديد
                            </a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class=" table table-bordered table-striped table-hover datatable datatable-Article">
                                <thead>
                                    <tr>
                                        <th width="10">

                                        </th>
                                        <th>
                                        #
                                        </th>
                                        <th>
                                        الاسم
                                        </th>
                                        
                                        <th>
                                           الفعالية
                                        </th>
                                        <th>
                                            نوع الخدمة
                                         </th>
                                        <th>
                                       الحالة
                                        </th>
                                      
                                        <th>
                                            &nbsp;
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $key => $order)
                                        <tr data-entry-id="{{ $order->id }}">
                                            <td>

                                            </td>
                                            <td>
                                                {{ $order->id ?? '' }}
                                            </td>
                                            <td>
                                                {{ $order->name ?? '' }}
                                            </td>
                                            <td>
                                               
                                               {{$order->event->name}}
                                            </td>
                                            <td>
                                               
                                                {{$order->category->name}}
                                             </td>
                                            <td>
                                               @if($order->publish==0)
                                               <span class="badge badge-warning ">معلق
                                               </span>                                                
                                               @else
                                               <span class="badge badge-info ">
                                                منشور
                                            </span> 
                                               @endif
                                            </td>
                                            <td>
                                            <a class="btn btn-xs btn-primary" href="#">
                                                        {{ trans('global.view') }}
                                            </a>
                                            <a class="btn btn-xs btn-info" href="#">
                                                العروض
                                            </a>
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
</section>

@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('article_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.articles.massDestroy') }}",
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
  let table = $('.datatable-Article:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection
{{--  --}}
