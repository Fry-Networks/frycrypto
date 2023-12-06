@extends('layouts.explorer-layout')
@section('page-title', 'Explorer')
@push('styles')
    <style>
        .accordion-header{
            border-radius: 50px;
        }

        .accordion-button {
            background-color: rgba(255, 255, 255, 0.51) !important;
            color: #333 !important;
            font-size: 19px;
        }

        .accordion-body {
            background-color: #f5f5f5 !important;
        }

        .accordion-button.collapsed {
            background-color: rgba(255, 255, 255, 0.7) !important;
            color: #333 !important;
        }
    </style>
@endpush
@section('content')
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-xl-12 col-xxl-12 d-flex">
                <div class="w-100">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div class="d-flex flex-column">
                                        <h4>Miners</h4>
                                        <h3 class="fw-bold">{{number_format($miners_count)}}</h3>
                                    </div>
                                    <img src="{{asset('assets/svgs/mining.svg')}}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div class="d-flex flex-column">
                                        <h4>Verified</h4>
                                        <h3 class="fw-bold">{{number_format($verified_count)}}</h3>
                                    </div>
                                    <i class="align-middle" style="width: 35px; height: 35px"
                                       data-feather="check"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div class="d-flex flex-column">
                                        <h4>Un Verified</h4>
                                        <h3 class="fw-bold">{{number_format($miners_count - $verified_count)}}</h3>
                                    </div>
                                    <i class="align-middle" style="width: 35px; height: 35px"
                                       data-feather="loader"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion" id="accordionPanelsStayOpenExample">
                @foreach($types_count as $type=>$miners)
                    <div class="accordion-item mb-3">
                        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#{{Str::slug($type)}}"
                                    aria-expanded="true"
                                    style="margin: 0 !important;"
                                    aria-controls="panelsStayOpen-collapseOne">
                                {{$type}}
                            </button>
                        </h2>
                        <div id="{{Str::slug($type)}}"
                             class="accordion-collapse collapse show"
                             aria-labelledby="panelsStayOpen-headingOne">
                            <div class="accordion-body">
                                <div class="row">
                                    @foreach($miners as $miner=>$count)
                                        <div class="col-md-4">
                                            <div class="card">
                                                <div
                                                    class="card-body d-flex justify-content-between align-items-center">
                                                    <div class="d-flex flex-column">
                                                        <h4>{{$miner}}</h4>
                                                        <h3 class="fw-bold">{{number_format($count)}}</h3>
                                                    </div>
                                                    <img src="{{asset('assets/svgs/mining.svg')}}"
                                                         alt="">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
