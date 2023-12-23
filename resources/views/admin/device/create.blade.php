@extends('layouts.app')

@section('content')
        <div>
            <h1>Add Miner Device</h1>
            <form action="{{ route('minerDevices.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="type">Type</label>
                    <select name="type" id="type" class="form-control @error('type') is-invalid @enderror">
                        <option value=Other" selected>Other</option>
                        <option value="Indoor Decibel">Indoor Decibel</option>
                        <option value="Indoor Decibel BYOD">Indoor Decibel BYOD</option>
                        <option value="Indoor Pebble">Indoor Pebble</option>
                        <option value="Bandwidth Hardware">Bandwidth Hardware</option>
                        <option value="Satellite Hardware">Satellite Hardware</option>
                        <option value="Satellite BYOD">Satellite BYOD</option>
                        <option value="Bandwidth BYOD">Bandwidth BYOD</option>
                    </select>
                    @error('type')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                @foreach(['email', 'license_number', 'order_number', 'algorand_address','first_and_last_name', 'imei_number', 'miner_key', 'byod_license_key','lat','lng'] as $field)
                    <div class="form-group">
                        <label for="{{ $field }}">{{ ucfirst(str_replace('_', ' ', $field)) }}</label>
                        <input type="text" name="{{ $field }}" id="{{ $field }}"
                               class="form-control @error($field) is-invalid @enderror">
                        @error($field)
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                @endforeach
                <button type="submit" class="btn btn-primary float-end mt-3">Create</button>
            </form>
        </div>
@endsection
