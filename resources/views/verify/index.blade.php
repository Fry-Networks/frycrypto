@extends('layouts.verify-layout')
@section('page-title', 'Verify/Update Location of miner')
@section('content')
    <div class="container-xl mt-4">
        <div class="card mb-4">
            <div class="card-header" style="background-color: #720b0b">
                <h3 class="text-white">Miner Information</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="minerName">Email:</label>
                            <input type="text" value="{{$miner->email}}" class="form-control" placeholder="Miner Name"
                                   readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="licenseId">Order Number:</label>
                            <input type="text" value="{{$miner->order_number}}" class="form-control" placeholder="License ID"
                                   readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="licenseId">License Number:</label>
                            <input type="text" value="{{$miner->license_number}}" class="form-control" placeholder="License ID"
                                   readonly>
                        </div>
                    </div>
                </div>
                <!-- Add more fields as needed -->
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
                <div id="map" class="border" style="height: 600px;"></div>
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
        const lat = {{$lat}};
        const lng = {{$lng}};
    </script>
    <script src="{{asset('assets/js/map_script.js')}}"></script>
@endsection
