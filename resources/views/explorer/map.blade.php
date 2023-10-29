@extends('layouts.explorer-layout')
@section('page-title', 'Explorer')
@section('content')
    <div id="explorer-map"></div>
    <div class="modal" tabindex="-1" id="hexagon-modal">
        <div class="modal-dialog" id="hexagon-content">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Modal body text goes here.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        const accessToken = "{{env('MAPBOX_ACCESS_TOKEN')}}";
        const hexDetailsRoute = "{{route('explorer.get-hexagon-details')}}";
        let points = @json(json_decode($points));
    </script>
    <script src="{{asset('assets/js/explorer_map.js')}}"></script>
@endpush
