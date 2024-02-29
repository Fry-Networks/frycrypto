@extends('layouts.dashboard-layout')
@section('page-title', 'Dashboard')
@push('styles')
    <style>
        .accordion-header {
            border-radius: 50px;
        }

        .accordion-button {
            background-color: rgba(255, 255, 255, 0.51) !important;
            color: #333 !important;
            font-size: 19px;
            margin: 0 !important;
        }

        .accordion-body {
            background-color: #f5f5f5 !important;
        }

        .accordion-button.collapsed {
            background-color: rgba(255, 255, 255, 0.7) !important;
            color: #333 !important;
        }

        .chart_container {
            width: 100% !important;
            height: 150px;
        }

        .status-circle {
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 50%;
        }

        .bg-success {
            background-color: green;
        }

        .bg-yellow {
            background-color: yellow;
        }

        .bg-warning {
            background-color: orange;
        }

        .bg-danger {
            background-color: red;
        }
    </style>
@endpush
@section('content')
    <livewire:dashboard.index :$address>
@endsection

