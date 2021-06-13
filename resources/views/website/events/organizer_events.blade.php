@extends('website.layouts.main')
@section('styles')
<link rel='stylesheet' href="{{asset('css/custom_profile_'.app()->getLocale().'.css')}}">
<style>
    header{background: #fff;}
    .menu .trigger{color:#a6217b}
    .btn-primary{
        padding:5px 10px;
        font-size:12px;
        font-weight: 200
    }
    a{
        font-weight: bold !important;
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
                        @if($user->group=='organizer')
                        <div style="margin-bottom: 10px;" class="row">
                            <div class="col-lg-12">
                                <a class="btn btn-success" href="{{ route('website.events.create') }}">
                                     {{ trans('website.menu.add_new_event') }}
                                </a>
                            </div>
                        </div>
                        @endif
                        <div class="table-responsive">
                            <table class=" table table-bordered table-striped table-hover datatable datatable-Article">
                                <thead>
                                    <tr>
                                       
                                        <th>
                                            {{ trans('website.menu.event') }}
                                        </th>
                                        
                                        <th>
                                            {{ trans('website.global.city') }}
                                        </th>
                                        <th>
                                            {{ trans('website.global.start_date') }}
                                        </th>
                                        <th>
                                            {{ trans('website.global.end_date') }}
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
                                                {{ $event->name ?? '' }}
                                            </td>
                                            <td>
                                                {{$event->city->name}}
                                            </td>
                                            <td>
                                                {{ $event->start_date ?? '' }}
                                            </td>
                                            <td>
                                                {{ $event->end_date ?? '' }}
                                            </td>
                                        
                                            <td>
                                                <a class="btn btn-xs btn-primary" href="{{ route('website.events.show', $event->id) }}">
                                                    {{ trans('website.global.view') }}
                                               </a>
                                           
                                           @if($user->group=='sponsor')
                                           <a class="btn btn-xs btn-primary" style="background:#007bff;border:#007bff" href="{{route('website.orders.index',['id'=>$event->id,'type'=>'sponsoring'])}}">
                                            {{ trans('website.menu.sponsoring_orders') }}
                                            </a>
                                           @endif
                                           @if($user->group=='provider')
                                           <a class="btn btn-xs btn-primary" style="background:#2c317c;border:#2c317c" href="{{route('website.orders.index',['id'=>$event->id,'type'=>'service'])}}">
                                            {{ trans('website.menu.service_orders') }}
                                            </a>
                                           @endif
                                            
                                            @if($user->group=='organizer')
                                            <a class="btn btn-xs btn-primary" style="background:#17a2b8;border:#17a2b8" href="{{route('website.booth.create',['id'=>$event->id])}}">
                                                {{ trans('website.menu.booth') }}
                                            </a>
                                            <a class="btn btn-xs btn-primary" style="background:#007bff;border:#007bff" href="{{route('website.orders.create',['id'=>$event->id,'type'=>'sponsoring'])}}">
                                                {{ trans('website.menu.sponsoring_orders') }}
                                            </a>
                                            <a class="btn btn-xs btn-primary" style="background:#2c317c;border:#2c317c" href="{{route('website.orders.create',['id'=>$event->id,'type'=>'service'])}}">
                                                {{ trans('website.menu.service_orders') }}
                                            </a>
                                            <a class="btn btn-xs btn-primary" style="background:#17b82c;border:#17b82c" href="{{route('website.tickets.create',['id'=>$event->id])}}">
                                                {{ trans('website.menu.tickets') }}
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
