@extends('layouts.explorer-layout')
@section('page-title', 'Explorer')
@section('content')
    <div class="container-fluid p-0">
        <div id="map" style="width: 100%; height: 1000px;"></div>
    </div>
@endsection
@push('scripts')
    <script>
        const access_token = '{{ env("MAPBOX_ACCESS_TOKEN", 'REDACTED_ROTATE_ME') }}';
        const locations = @json($miners);
        console.log(access_token)
    </script>
    <script src="{{asset('assets/js/explorer_map.js')}}"></script>
@endpush
