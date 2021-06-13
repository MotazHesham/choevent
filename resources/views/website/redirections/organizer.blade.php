@extends('website.layouts.main')
@section('styles')
<style>
    header{background: #fff;}
    .menu .trigger{color:#a6217b}
</style>
@endsection
@section('content')
@include('website.partials.header-2')
@include('website.partials.breadcrumb')
<section class="service_organizers bg_custom_1507727948742">
        
        
    <div class="container p-50">
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-info">
                    {{trans('website.messages.organizer_account')}}
                    
                </div>
            </div>
        </div>
    </div>
       
        
        
    

        <!----------sponsors------------->
    
    
    
    </section>
@endsection