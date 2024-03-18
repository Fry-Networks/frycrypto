@extends('layouts.verify-layout')
@section('page-title', 'Verify/Update Location of miner')
@section('content')
    <div class="container-xl mt-4">
        <div class="mb-3 d-flex">
            <a class="btn btn-sm btn-success" href="{{route('verify-miner')}}"><i class="fas fa-home"></i> Home</a>
        </div>
        <div class="card mb-4">
            <div class="card-header" style="background-color: #720b0b">
                <h3 class="text-white">Miner Information</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                        @php($include = ['email', 'algorand_address', 'type'])
                        @foreach($miner->toArray() as $key => $value)
                            @if(!empty($value) && in_array($key, $include))
                                <tr>
                                    <td><strong>{{ucfirst($key)}}</strong></td>
                                    <td>{{$value}}</td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="input-group mb-3">
                    <input type="text" id="search" class="form-control" placeholder="Search location">
                    <div class="input-group-append">
                        <button id="show-location" class="btn btn-success">Current Location</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="map" class="border" style="height: 600px; border-radius: 5px"></div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="input-group mb-3">
                    <input type="text" id="marker_location" class="form-control" placeholder="Drop a Marker" readonly>
                    <div class="input-group-append">
                        <button id="submit" class="btn btn-success">Save Location</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="banner-container">
        </div>
    </div>
    <script>
        const minerId = {{$miner->id}};
        const lat = {{$lat}};
        const lng = {{$lng}};
    </script>
    <script src="{{asset('assets/js/map_script.js')}}"></script>
@endsection
