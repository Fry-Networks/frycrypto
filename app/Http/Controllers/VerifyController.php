<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

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
            'dashboard_route' => route('dashboard.index', ['address' => Crypt::encryptString($address)]),
        ]);
    }

    public function connectWallet()
    {
        return view('verify.verify');
    }
}
