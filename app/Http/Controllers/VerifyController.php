<?php

namespace App\Http\Controllers;

use App\Models\MinerDevices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class VerifyController extends Controller
{
    public function verify(Request $request)
    {
        $activeAccount = $request->input('activeAccount');
        $address = $activeAccount['address'];
        $name = $activeAccount['name'];
        $provider_id = $activeAccount['providerId'];
        $activeAccount = $request->input('activeAccount');
        $miner = MinerDevices::query()->where('algorand_address', $address)->first();
        if ($miner) {
            $miner->name = $name;
            $miner->provider_id = $provider_id;
            $miner->save();
            $request->session()->put('miner_id', $miner->id);
            return response()->json([
                'status' => 'success',
                'route' => route('verify.home'),
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Account is not verified',
                'data' => null
            ]);
        }
    }

    public function connectWallet()
    {
        return view('verify.verify');
    }
}
