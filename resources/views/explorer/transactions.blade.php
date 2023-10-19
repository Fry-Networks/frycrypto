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
                                        <select class="form-control form-select border-0" style="background-color: #ececec" id="type-filter">
                                            @foreach($types as $type)
                                                <option value="{{$type}}">{{ucfirst($type)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <hr />
                                    <table class="table" id="transactions_table">
                                        <thead>
                                        <tr>
                                            <th>Hash</th>
                                            <th>Block</th>
                                            <th>Type</th>
                                            <th>Age</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($transactions as $transaction)
                                            <tr>
                                                <td>{{ $transaction['id'] }}</td> <!-- Hash -->
                                                <td>{{ $transaction['confirmed-round'] }}</td> <!-- Block -->
                                                <td><span class="badge bg-warning px-3">{{$transaction['tx-type']}}</span></td>
                                                <td>{{formatAgeFromTimestamp($transaction['round-time'])}}</td>
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
            var table = $('#transactions_table').DataTable({
                pageLength: 25,
            });

            $('#type-filter').on('change', function () {
                var selectedType = $(this).val();
                table.column(2)  // Assuming the 'Type' column is the third column in the table
                    .search(selectedType ? '^'+selectedType+'$' : '', true, false)
                    .draw();
            });
        });
    </script>
@endpush

