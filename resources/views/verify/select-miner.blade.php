@extends('layouts.verify-layout')
@section('page-title', 'Select a miner to verify')
@section('content')
    <div class="container-xl mt-4">
        <div class="card mb-4" style="background: transparent;">
            <div class="card-body">
                <div class="row">
                    @if($miners->count() > 0)
                        <form action="{{route('verify.home')}}" method="POST">
                            @csrf
                            <label for="miner-select"></label>
                            <select class="form-control" id="miner-select" name="miner_id">
                                <option value="">Select a miner</option>
                                @foreach($miners as $miner)
                                    <option value="{{$miner->id}}"><strong>{{$miner->type}}</strong> - {{$miner->email}}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-success mt-3">Select</button>
                        </form>
                    @else
                        <div class="d-flex flex-column justify-content-center align-items-center">
                            <h2 style="color: darkred">No miner attached to the address</h2>
                            <a class="btn btn-sm btn-danger w-25" href="{{route('verify-miner')}}">Go back to wallet connect</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
