@extends('layouts.explorer-layout')
@section('page-title', 'Explorer')
@section('content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Miners</h1>
        <div class="row">
            <div class="col-xl-12 col-xxl-12 d-flex">
                <div class="w-100">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="form-group d-flex col-md-4  flex-nowrap align-items-center">
                                    <label for="tx_type" class="w-25">Miner Type</label>
                                    <select class="form-control form-select border-0" style="background-color: #ececec"
                                            name="tx_type" id="tx_type">
                                        <option value="">Select Type</option>
                                        @foreach($types as $type)
                                            <option value="{{ $type }}">{{ $type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <hr/>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Address</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Maker</th>
                                        <th>Reward(tAKRE)</th>
                                        <th>Onboarding Time</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($miners as $miner)
                                        <tr>
                                            <td class="text-success">
                                                <a href="{{route('explorer.view-miner', $miner->id)}}">
                                                    {{secretString($miner->algorand_address)}}
                                                </a>
                                            </td>
                                            <td>
                                                <span class="badge bg-warning px-3">{{$miner->type}}</span>
                                            </td>
                                            <td>
                                                <span class="badge bg-success px-3">Normal</span>
                                            </td>
                                            <td>FryCrypto</td>
                                            <td>0.000000</td>
                                            <td>{{$miner->updated_at->diffForHumans()}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
