<?php

namespace App\Services;

use App\Algorand\Algorand;

class AlgorandService
{
    protected Algorand $algodClient;

    public function __construct()
    {
        $token = env('NODE_TOKEN');
        $baseUrl = env('NODE_BASEURL');
        $port = env('NODE_PORT');

        $this->algodClient = new Algorand('algod', $token, $baseUrl, $port, false);
    }

    public function getClient(): Algorand
    {
        return $this->algodClient;
    }
}
