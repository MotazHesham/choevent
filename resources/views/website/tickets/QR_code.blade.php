@extends('website.layouts.main')
@section('styles')
<style>
</style>
@endsection
@section('content')
@include('website.partials.header-2')
@include('website.partials.breadcrumb')
<div class="visible-print text-center">
    {!! QrCode::size(100)->generate(Request::url()); !!}
    <p>Scan me to return to the original page.</p>
</div>
@endsection