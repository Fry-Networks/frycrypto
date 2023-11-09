@extends('layouts.explorer-layout')
@section('page-title', 'Explorer')
@section('content')
    <div class="container mt-5">
        <div class="card mb-4 shadow">
            <div class="card-body">
                <h6 class="card-subtitle mb-2 text-muted">Account</h6>
                <h4 class="card-title" style="color: #d9534f;">{{ $account['account']['address'] }}</h4>

                <div class="row mt-4">
                    <div class="col-4">
                        <strong>Total Assets Opted In:</strong> <span class="text-danger">{{ $account['account']['total-assets-opted-in'] }}</span> <br>
                    </div>
                    <div class="col-4">
                        <strong>Status:</strong> {{ $account['account']['status'] }} <br>
                    </div>
                    <div class="col-4">
                        <strong>Amount:</strong> {{ number_format($account['account']['amount']) }} <br>
                    </div>
                </div>
            </div>
        </div>
        @if(isset($account['account']['assets']))
            <!-- Assets Card -->
            <div class="card shadow">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 text-muted">Assets</h6>
                    @foreach ($account['account']['assets'] as $asset)
                        <div class="p-2 mb-3 bg-light rounded">
                            <strong>Asset ID:</strong> {{ $asset['asset-id'] }} <br>
                            <strong>Amount:</strong> {{ $asset['amount'] }} <br>
                            <strong>Opted In At Round:</strong> {{ $asset['opted-in-at-round'] }} <br>
                            <strong>Status:</strong> {{ $asset['is-frozen'] ? 'Frozen' : 'Not Frozen' }}
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
