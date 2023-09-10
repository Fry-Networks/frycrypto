<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VerifyController extends Controller
{
    public function verify(Request $request)
    {
        $activeAccount = $request->input('activeAccount');

        return response()->json(['message' => 'Active account stored successfully']);
    }
}
