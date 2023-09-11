<?php

namespace App\Http\Controllers;

use App\Imports\MinerDeviceImport;
use App\Models\MinerDevices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function index()
    {
        $minerDevices = MinerDevices::query()->select('id', 'algorand_address', 'type', 'email')->get();
        return view('admin.device.index', compact('minerDevices'));
    }

    public function create()
    {
        return view('admin.device.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'algorand_address' => 'required|string',
        ]);

        MinerDevices::create($request->all());

        return redirect()->route('minerDevices.index')->with('status', 'Device created successfully');
    }


    // Display the form for importing MinerDevices
    public function import()
    {
        return view('admin.device.import');
    }

    public function importProcess(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,xlsx,xls|max:2048',
        ]);

        $file = $request->file('file');
        $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $type = str_replace(' Registration', '', $fileName);
        $validTypes = [
            'Indoor Decibel',
            'Indoor Decibel BYOD',
            'Indoor Pebble',
            'Bandwidth Hardware',
            'Satellite Hardware',
            'Satellite BYOD',
            'Bandwidth BYOD',
            'Other'
        ];
        if (!in_array($type, $validTypes)) {
            $type = 'Other';
        }
        Excel::import(new MinerDeviceImport($type), $file);

        return redirect()->route('minerDevices.index')->with('status', 'Devices imported successfully');
    }

    // Display the form for editing an existing MinerDevice
    public function edit($id)
    {
        $device = MinerDevices::findOrFail($id);
        return view('admin.device.edit', ['device' => $device]);
    }

    public function update(Request $request, $id)
    {
        $device = MinerDevices::findOrFail($id);

        $data = $request->validate([
            'algorand_address' => 'required|string',
        ]);

        $device->update($data);

        return redirect()->route('minerDevices.index')->with('status', 'Device updated successfully');
    }

    // Delete an existing MinerDevice
    public function delete($id)
    {
        $device = MinerDevices::findOrFail($id);
        $device->delete();

        return redirect()->route('minerDevices.index')->with('status', 'Device deleted successfully');
    }

}
