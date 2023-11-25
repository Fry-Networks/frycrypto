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
        session(['algo_address' => $address]);
        return response()->json([
            'status' => 'success',
            'route' => route('verify.home'),
        ]);
    }

    public function connectWallet()
    {
        return view('verify.verify');
    }
}
