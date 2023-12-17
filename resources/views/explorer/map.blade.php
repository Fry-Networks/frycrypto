@extends('layouts.explorer-layout')
@section('page-title', 'Explorer')
@section('content')
    <style>
        #tooltip {
            background: white;
            border: 1px solid #000;
            padding: 5px;
            font-size: 12px;
        }

    </style>
    <input id="map-search" class="form-control map-search-box" type="text" placeholder="Search location...">
    <div id="explorer-map"></div>
    <div class="modal fade" id="hexagon_modal" tabindex="-1" aria-labelledby="modalHexagon" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" id="hexagon_content" style="opacity: 0.9"></div>
    </div>
    <div id="tooltip" style="position: absolute; pointer-events: none; display: none;"></div>

@endsection
@push('scripts')
    <script src="https://d3js.org/d3-hexbin.v0.2.min.js"></script>
    <script>
        const accessToken = "{{config('app.mapbox_access_token')}}";
        let points = @json(json_decode($points));
        let dataUrl = '{{route('explorer.get-hexagon-details')}}';
    </script>
    <script src="{{asset('assets/js/explorer_map.js')}}"></script>

    <script defer
            src="https://maps.googleapis.com/maps/api/js?key={{config('app.google_api_key')}}&callback=initExplorerMap&libraries=places">
    </script>
@endpush
