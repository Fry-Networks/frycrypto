<?php

namespace App\Http\Controllers;

use App\Services\AlgorandService;
use Illuminate\Http\Request;

class ExplorerController extends Controller
{
    protected AlgorandService $algorand_service;

    public function __construct(AlgorandService $algorandService)
    {
        $this->algorand_service = $algorandService;
    }

    public function dashboard()
    {
//        dd($this->algorand_service->fetchTransactions());
        return view('explorer.index');
    }

    public function miners()
    {
        return view('explorer.miners');
    }

    public function blocks()
    {
        $blocks = [];
        $data = $this->algorand_service->fetchBlocks();
        if ($data === null) return view('explorer.blocks', compact('blocks'));  // handle error
        $blocks[] = $data['blocks'];
        while (isset($data['next-token']) && $data['next-token'] != null) {
            $data = $this->algorand_service->fetchBlocks(['next' => $data['next-token']]);
            if ($data === null) break;  // stop loop on error
            $blocks[] = $data['blocks'];
        }
        // Flatten the account array
        $blocks = array_reduce($blocks, function ($carry, $item) {
            return array_merge($carry, $item);
        }, []);
        dd($blocks);
        return view('explorer.blocks', compact('blocks'));
    }

    public function accounts()
    {
        $accounts = [];
        $data = $this->algorand_service->fetchAccounts();
        if ($data === null) return view('explorer.accounts', compact('accounts'));  // handle error
        $accounts[] = $data['accounts'];
        while (isset($data['next-token']) && $data['next-token'] != null) {
            $data = $this->algorand_service->fetchAccounts(['next' => $data['next-token']]);
            if ($data === null) break;  // stop loop on error
            $accounts[] = $data['accounts'];
        }
        // Flatten the account array
        $accounts = array_reduce($accounts, function ($carry, $item) {
            return array_merge($carry, $item);
        }, []);
        return view('explorer.accounts', compact('accounts'));
    }


    public function transactions()
    {
        $transactions = $types = [];
        $data = $this->algorand_service->fetchTransactions();
        if ($data === null) return view('explorer.transactions', compact('transactions', 'types'));  // handle error
        $transactions[] = $data['transactions'];
        while (isset($data['next-token']) && $data['next-token'] != null) {
            $data = $this->algorand_service->fetchTransactions(['next' => $data['next-token']]);
            if ($data === null) break;  // stop loop on error
            $transactions[] = $data['transactions'];
        }
        // Flatten the account array
        $transactions = array_reduce($transactions, function ($carry, $item) {
            return array_merge($carry, $item);
        }, []);
        $types = array_unique(array_map(function ($transaction) {
            return $transaction['tx-type'];
        }, $transactions));

        return view('explorer.transactions', compact('transactions', 'types'));
    }
}
