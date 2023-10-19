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
                            <div class="table-responsive" id="blocks_table">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Height</th>
                                        <th>Block Hash</th>
                                        <th>Transactions</th>
                                        <th>Age</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($blocks as $block)
                                        <tr>
                                            <td class="text-success fw-bold">akdjfskfjskdf</td>
                                            <td>150,401</td>
                                            <td>
                                                <span class="badge bg-warning px-3">TX_Report</span>
                                            </td>
                                            <td>1 mins 2 secs ago</td>
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
        $(document).ready(function () {
            $('#blocks_table').DataTable({
                pageLength: 25,
            });
        });
    </script>
@endpush
