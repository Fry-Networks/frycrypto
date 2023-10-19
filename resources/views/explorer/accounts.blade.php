@extends('layouts.explorer-layout')
@section('page-title', 'Explorer - Accounts')
@section('content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Accounts</h1>
        <div class="row">
            <div class="col-xl-12 col-xxl-12 d-flex">
                <div class="w-100">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="accounts-table">
                                    <thead>
                                    <tr>
                                        <th>Address</th>
                                        <th>Reward(tAKRE)</th>
                                        <th>Type</th>
                                        <th>Age</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($accounts as $account)
                                        <tr>
                                            <td class="text-danger fw-bold">{{$account['address']}}</td>
                                            <td>{{number_format($account['rewards'], 2)}}</td>
                                            <td>
                                                <span class="badge {{$account['status'] == 'Offline' ? 'bg-danger' : 'bg-success'}} px-3">{{$account['status']}}</span>
                                            </td>
                                            <td>{{formatAge($account['created-at-round'])}}</td>
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
@push('scripts')
    <script type="text/javascript">
        $(document).ready( function () {
            $('#accounts-table').DataTable({
                pageLength: 25,
            });
        });
    </script>
@endpush
