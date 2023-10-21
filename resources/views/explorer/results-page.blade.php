@extends('layouts.explorer-layout')
@section('page-title', 'Explorer')
@section('content')
    <div class="container-fluid p-0" >
        <h1 class="h3 mb-3">{{ucfirst($page)}}</h1>
        <div class="row">
            <div class="col-xl-12 col-xxl-12 d-flex">
                <div class="w-100">
                    <div class="card">
                        <div class="card-body">
                            <livewire:explorer.table-component :type="$page"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
