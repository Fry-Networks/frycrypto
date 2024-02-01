@extends('layouts.dashboard-layout')
@section('page-title', 'Transactions')
@section('content')
    <div class="container-fluid p-0" >
        <h1 class="h3 mb-3">Miner Transactions</h1>
        @livewire('dashboard.transactions', ['note' => $note])
    </div>
@endsection
