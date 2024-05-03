<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\App;

class AlgonodeService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://mainnet-idx.algonode.cloud',
            'verify' => !App::environment('local')
        ]);
    }

    public function fetchBlocks($round, $params = [])
    {
        $response = $this->client->request('GET', '/v2/blocks/'.$round, [
            'query' => $params
        ]);
        return json_decode($response->getBody(), true);
    }

    public function fetchTransactions($params = [])
    {
        $response = $this->client->request('GET', '/v2/transactions', [
            'query' => $params
        ]);
        return json_decode($response->getBody(), true);
    }

    public function fetchAccounts($params = [])
    {
        try {
            $response = $this->client->request('GET', '/v2/accounts', [
                'query' => $params
            ]);
            return json_decode($response->getBody(), true);
        } catch (RequestException $exception) {
            return null;
        }
    }

    public function getTransaction($id)
    {
        $response = $this->client->request('GET', '/v2/transactions/'.$id);
        return json_decode($response->getBody(), true);
    }

    public function getAccount($id)
    {
        $response = $this->client->request('GET', '/v2/accounts/'.$id);
        return json_decode($response->getBody(), true);
    }

    public function getBlock($id)
    {
        $response = $this->client->request('GET', '/v2/blocks/'.$id);
        return json_decode($response->getBody(), true);
    }
}
