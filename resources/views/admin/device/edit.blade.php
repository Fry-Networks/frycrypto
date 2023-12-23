@extends('layouts.app')

@section('content')
        <div>
            <h1>Edit Miner Device</h1>
            <form action="{{ route('minerDevices.update', $device->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="type">Type</label>
                    <select name="type" id="type" class="form-control @error('type') is-invalid @enderror">
                        <option value="Other" {{ $device->type == 'Other' ? 'selected' : '' }}>Other</option>
                        <option value="Indoor Decibel" {{ $device->type == 'Indoor Decibel' ? 'selected' : '' }}>Indoor Decibel</option>
                        <option value="Indoor Decibel BYOD" {{ $device->type == 'Indoor Decibel BYOD' ? 'selected' : '' }}>Indoor Decibel BYOD</option>
                        <option value="Indoor Pebble" {{ $device->type == 'Indoor Pebble' ? 'selected' : '' }}>Indoor Pebble</option>
                        <option value="Bandwidth Hardware" {{ $device->type == 'Bandwidth Hardware' ? 'selected' : '' }}>Bandwidth Hardware</option>
                        <option value="Satellite Hardware" {{ $device->type == 'Satellite Hardware' ? 'selected' : '' }}>Satellite Hardware</option>
                        <option value="Satellite BYOD" {{ $device->type == 'Satellite BYOD' ? 'selected' : '' }}>Satellite BYOD</option>
                        <option value="Bandwidth BYOD" {{ $device->type == 'Bandwidth BYOD' ? 'selected' : '' }}>Bandwidth BYOD</option>
                    </select>
                    @error('type')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                @foreach(['email', 'license_number', 'order_number', 'algorand_address','first_and_last_name', 'imei_number', 'miner_key', 'byod_license_key','lat','lng'] as $field)
                    <div class="form-group">
                        <label for="{{ $field }}">{{ ucfirst(str_replace('_', ' ', $field)) }}</label>
                        <input type="text" name="{{ $field }}" id="{{ $field }}"
                               class="form-control @error($field) is-invalid @enderror" value="{{ $device->$field }}">
                        @error($field)
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                @endforeach
                <button type="submit" class="btn btn-primary float-end mt-3">Update</button>
            </form>
        </div>
@endsection
