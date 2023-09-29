<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExplorerController extends Controller
{
    public function transactions()
    {
        return view('explorer.transactions');
    }
}
