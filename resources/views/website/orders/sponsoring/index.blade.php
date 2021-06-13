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
    input , select ,textarea {
       border: 2px solid #e0e0e0  !important;
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
                           <a class="btn btn-xs btn-primary" href="{{route('website.events.show',['id'=>$event->id])}}">
                                الذهاب إلى صفحة الفعالية
                            </a>
                           </div>
                           <div class="mb-2 mx-2">
                            <a class="btn btn-xs btn-primary" style="background: #2c317c;border:#2c317c" href="{{route('website.organizers.show',['id'=>$event->user_id])}}">
                                 الذهاب إلى صفحة منظم الفعالية
                             </a>
                            </div>
                       </div>
                        <div class="table-responsive">
                            <table class=" table table-bordered table-striped table-hover datatable datatable-Article">
                                <thead>
                                    <tr>
                                       
                                        <th>
                                        الاسم
                                        </th>
                                       
                                        <th>
                                           الفئة
                                         </th>
                                         <th>
                                            قيمة الرعاية
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
                                                {{ $order->name ?? '' }}
                                            </td>
                                            
                                            <td>
                                               
                                                {{$order->classification}}
                                             </td>
                                             <td>
                                               
                                                {{$order->price}} ريال
                                             </td>
                                            <td>
                                               @if($order->publish==0)
                                               <span class="badge badge-warning ">معلق
                                               </span>                                                
                                               @elseif($order->publish==1)
                                               <span class="badge badge-info ">
                                                منشور
                                               </span>
                                               @elseif($order->publish==2) 
                                               <span class="badge badge-success ">
                                                مغلق
                                               </span>
                                               @endif
                                            </td>
                                            
                                        
                                            <td>
                                            <a class="btn btn-xs btn-primary" href="{{route('website.orders.show',['id'=>$order->id])}}">
                                                       تفاصيل الطلب
                                            </a>
                                            @if($user->group=='sponsor' &&$order->publish==1)
                                              <a class="btn btn-xs btn-info" href="{{route('website.offers.create',['type'=>'sponsoring','order_id'=>$order->id,'event_id'=>$order->event->id])}}">
                                                إضافة عرض
                                              </a>
                                            @elseif($user->group=='organizer')
                                            <a class="btn btn-xs btn-info" href="{{route('website.offers.index',['type'=>'sponsoring'])}}">
                                               العروض
                                            </a>
                                            @endif
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
