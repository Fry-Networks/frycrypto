<?php

namespace App\Services;

use App\Algorand\Algorand;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class AlgorandService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://testnet-algorand.api.purestake.io/idx2/',
            'headers' => ['X-API-Key' => env('PURESTAKE_API_KEY')]
        ]);
    }

    public function fetchBlocks($params = [])
    {
        $response = $this->client->request('GET', 'v2/blocks', [
            'query' => $params
        ]);
        return json_decode($response->getBody(), true);
    }

    public function fetchTransactions($params = [])
    {
        $response = $this->client->request('GET', 'v2/transactions', [
            'query' => $params
        ]);
        return json_decode($response->getBody(), true);
    }

    public function fetchAccounts($params = [])
    {
        try {
            $response = $this->client->request('GET', 'v2/accounts', [
                'query' => $params
            ]);
            return json_decode($response->getBody(), true);
        } catch (RequestException $exception) {
            return null;
        }
    }
}
