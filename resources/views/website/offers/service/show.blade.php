@extends('website.layouts.main')
@section('styles')
<link rel='stylesheet' href="{{asset('css/custom_profile_'.app()->getLocale().'.css')}}">
<style>
    header{background: #fff;}
    .menu .trigger{color:#a6217b}
    table .btn{
    font-family: 'noorregular';
    font-size: 11px;
    padding: 5px 10px;
    border-radius: 20px;
    color: #fff;
    text-decoration: none;
    text-align: center;
    border:1px ;
    }
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
                       <div class="table-responsive">
                            <table class=" table table-bordered table-striped table-hover datatable datatable-Article">
                                <thead>
                                    <tr>
                                       <th>مقدم الخدمة</th>
                                    <th>{{$offer->service_provider->name}}</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                   <tr>
                                       <td>العرض</td>
                                   <td>{{$offer->name}}</td>
                                   </tr>
                                   <tr>
                                    <td>قيمة العرض</td>
                                    <td>{{$offer->price}}</td>
                                </tr>
                                   <tr>
                                       <td>تفاصيل العرض</td>
                                       <td>{!!$offer->description!!}</td>
                                   </tr>
                                   <tr>
                                       <td> 
                                            @if($user->group=='organizer' && $offer->order->publish==1)
                                        <a class="btn btn-xs btn-info" href="{{route('website.offers.confirm',['id'=>$offer->id])}}">
                                            الموافقة على العرض
                                        </a>
                                        @endif</td>
                                       <td></td>
                                   </tr>
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
