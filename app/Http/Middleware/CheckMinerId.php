<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckMinerId
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->session()->has('algo_address')) {
            return redirect()->route('verify-miner');
        }
        return $next($request);
    }
}
