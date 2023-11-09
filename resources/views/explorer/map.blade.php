@extends('layouts.explorer-layout')
@section('page-title', 'Explorer')
@section('content')
        <input id="map-search" class="form-control map-search-box" type="text" placeholder="Search location...">
        <div id="explorer-map"></div>
@endsection
@push('scripts')
    <script>
        const accessToken = "{{config('app.mapbox_access_token')}}";
        let points = @json(json_decode($points));
    </script>
    <script src="{{asset('assets/js/explorer_map.js')}}" defer></script>
@endpush
