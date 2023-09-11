@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Import Miner Devices</h1>
        <form action="{{ route('minerDevices.importFile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="file">Choose CSV File</label>
                <input type="file" name="file" id="file" class="form-control @error('file') is-invalid @enderror">
                @error('file')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary float-end mt-3">Import</button>
        </form>
    </div>
@endsection
