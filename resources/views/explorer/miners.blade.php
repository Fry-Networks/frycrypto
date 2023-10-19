@extends('layouts.explorer-layout')
@section('page-title', 'Explorer')
@section('content')
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3">Transactions</h1>
            <div class="row">
                <div class="col-xl-12 col-xxl-12 d-flex">
                    <div class="w-100">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="form-group d-flex col-md-4  flex-nowrap align-items-center">
                                        <label for="tx_type" class="w-25">Tx Type</label>
                                        <select class="form-control form-select border-0" style="background-color: #ececec" name="tx_type" id="tx_type">
                                            <option>Account 1</option>
                                            <option>Account 2</option>
                                            <option>Account 3</option>
                                            <option>Account 4</option>
                                            <option>Account 5</option>
                                        </select>
                                    </div>
                                    <hr />
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Hash</th>
                                            <th>Block</th>
                                            <th>Type</th>
                                            <th>Age</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="text-success fw-bold">akdjfskfjskdf</td>
                                            <td>150,401</td>
                                            <td>
                                                <span class="badge bg-warning px-3">TX_Report</span>
                                            </td>
                                            <td>1 mins 2 secs ago</td>
                                        </tr>
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
