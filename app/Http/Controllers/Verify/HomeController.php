<?php

namespace App\Http\Controllers\Verify;

use App\Http\Controllers\Controller;
use App\Models\MinerDevices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $miner_id = session('miner_id');
        $miner = MinerDevices::query()->find($miner_id);
        $lat = $miner->lat ?? 40.7128;
        $lng = $miner->lng ?? -74.0060;
        return view('verify.index', compact('miner', 'lat', 'lng'));
    }

    public function saveCoordinates(Request $request)
    {
        $miner_id = session('miner_id');
        $miner = MinerDevices::query()->find($miner_id);
        $miner->lat = $request->latitude;
        $miner->lng = $request->longitude;
        $miner->save();
        return response()->json(['status' => 'success']);
    }
}
