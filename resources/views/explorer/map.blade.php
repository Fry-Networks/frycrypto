@extends('layouts.explorer-layout')
@section('page-title', 'Explorer')
@section('content')
    <input id="map-search" class="form-control map-search-box" type="text" placeholder="Search location...">
    <div id="explorer-map"></div>
    <div class="modal fade" id="hexagon_modal" tabindex="-1" aria-labelledby="modalHexagon" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" id="hexagon_content" style="opacity: 0.9"></div>
    </div>
@endsection
@push('scripts')
    <script>
        const accessToken = "{{config('app.mapbox_access_token')}}";
        let points = @json(json_decode($points));
        let dataUrl = '{{route('explorer.get-hexagon-details')}}';
    </script>
    <script src="{{asset('assets/js/explorer_map.js')}}" defer></script>
@endpush
