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
                        <div class="row">
                            <div class="mb-2 mx-2">
                            <a class="btn btn-xs btn-primary" href="{{route('website.events.show',['id'=>$order->event->id])}}">
                                 الذهاب إلى صفحة الفعالية
                             </a>
                            </div>
                            <div class="mb-2 mx-2">
                             <a class="btn btn-xs btn-primary" style="background: #2c317c;border:#2c317c" href="{{route('website.organizers.show',['id'=>$order->event->user_id])}}">
                                  الذهاب إلى صفحة منظم الفعالية
                              </a>
                             </div>
                        </div>
                       <div class="table-responsive">
                            <table class=" table table-bordered table-striped table-hover datatable datatable-Article">
                                <thead>
                                    <tr>
                                    <td>الطلب</td>
                                    <td>{{$order->name}}</td> 
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                       <td>تفاصيل الطلب</td>
                                    <td>{!!$order->description!!}</td> 
                                    </tr>
                                   
                                    <tr>
                                        <td>فئة الرعاية</td>
                                    <td>{{$order->classification}}</td>
                                    </tr>
                                    <tr>
                                        <td>قيمة الرعاية</td>
                                    <td>{{$order->price}} ريال</td> 
                                    </tr>
                                    @if($user->group=='sponsor' && $order->publish==1)
                                    <tr>
                                        <td>
                                            <a class="btn btn-xs btn-success" href="{{route('website.orders.confirm',['type'=>'sponsoring','id'=>$order->id])}}">
                                                الموافقة على الطلب
                                            </a>
                                            <a class="btn btn-xs btn-info" href="{{route('website.offers.create',['type'=>'sponsoring','order_id'=>$order->id,'event_id'=>$order->event->id])}}">
                                                إضافة عرض
                                            </a>
                                        </td>
                                        <td>
                                        </td>
                                    </tr>
                                    @endif
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
