@extends('layouts.explorer-layout')
@section('page-title', 'Explorer')
@section('content')
    <div class="container mt-5">
        <div class="card mb-4 shadow">
            <div class="card-body">
                <h6 class="card-subtitle mb-2 text-muted">Miner</h6>
                <h4 class="card-title" style="color: #d9534f;">{{$miner->algorand_address}}</h4>
                <div class="row mt-4">
                    <div class="col-4">
                        <strong>Type:</strong> <span class="text-danger">{{$miner->type}}</span> <br>
                    </div>
                    <div class="col-4">
                        <strong>Status:</strong> Normal <br>
                    </div>
                     <div class="col-4">
                        <strong>Maker:</strong>  Fry Foundation <br>
                    </div>
                    <div class="col-4">
                        <strong>Onboarding Time:</strong> {{$miner->created_at->diffForHumans()}} <br>
                    </div>
                </div>
            </div>
        </div>
@endsection
