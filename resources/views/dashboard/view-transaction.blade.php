@extends('layouts.dashboard-layout')
@section('page-title', 'Dashboard')
@section('content')
    <div class="container mt-5">
        <div class="card mb-4 shadow">
            <div class="card-body">
                <h6 class="card-subtitle mb-2 text-muted">Transaction</h6>
                <h4 class="card-title" style="color: #d9534f;">{{ $transaction['transaction']['id'] }}</h4>
                <div class="row mt-4">
                    <div class="col-3">
                        <strong>Current Round:</strong> <span class="text-danger">{{ $transaction['current-round'] }}</span>
                        <br>
                    </div>
                    <div class="col-3">
                        <strong>Confirmed Round:</strong> {{ $transaction['transaction']['confirmed-round'] }} <br>
                    </div>
                    <div class="col-3">
                        <strong>Fee:</strong> {{ $transaction['transaction']['fee'] }} <br>
                    </div>
                    <div class="col-3">
                        <strong>Round Time:</strong> {{ date('Y-m-d H:i:s', $transaction['transaction']['round-time']) }} <br>
                    </div>
                </div>
            </div>
        </div>

        <!-- Second Card -->
        <div class="card shadow">
            <div class="card-body">
                <h6 class="card-subtitle mb-2 text-muted">Transaction Data</h6>
                <pre class="bg-light p-3 rounded">
                    Genesis Hash: {{ $transaction['transaction']['genesis-hash'] }}
                    Genesis ID: {{ $transaction['transaction']['genesis-id'] }}
                    Sender: {{ $transaction['transaction']['sender'] }}
                    Tx Type: {{ $transaction['transaction']['tx-type'] }}
                </pre>
            </div>
        </div>
    </div>

@endsection
