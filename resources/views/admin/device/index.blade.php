@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="container mt-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1>MinerDevices</h1>
                    <div>
                        <a class="btn btn-outline-success" href="{{route('minerDevices.import')}}"><i class="fas fa-file-import"></i> Import
                        </a>
                        <a class="btn btn-outline-success" href="{{route('minerDevices.create')}}"><i class="fas fa-plus"></i> Create
                        </a>
                    </div>
                </div>
                <table id="minerDevicesTable" class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Email</th>
                        <th>Algorand Address</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($minerDevices as $device)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ $device->email }}</td>
                            <td>{{ $device->algorand_address }}</td>
                            <td>{{ $device->type }}</td>
                            <td>
                                <a href="{{ route('minerDevices.edit', $device->id) }}"
                                   class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a>
                                <a href="{{ route('minerDevices.delete', $device->id) }}"
                                   class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('#minerDevicesTable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endpush
