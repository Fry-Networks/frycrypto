<?php

namespace App\Http\Controllers\Verify;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('verify.index');
    }
}
