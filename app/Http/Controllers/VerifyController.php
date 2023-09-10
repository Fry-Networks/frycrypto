<?php

namespace App\Http\Controllers;

use App\Models\MinerDevices;
use Illuminate\Http\Request;

class VerifyController extends Controller
{
    public function verify(Request $request)
    {
        $activeAccount = $request->input('activeAccount');
        $miner = MinerDevices::query()->where('algorand_address', $activeAccount)->first();
        if ($miner) {
            return response()->json([
                'status' => 'success',
                'message' => 'Account is verified',
                'data' => $miner
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Account is not verified',
                'data' => null
            ]);
        }
    }
}
