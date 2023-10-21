<?php

namespace App\Livewire\Explorer;

use App\Services\AlgorandService;
use Illuminate\Http\Request;
use Livewire\Component;

class TableComponent extends Component
{
    protected AlgorandService $algorand_service;
    public $transactions;
    public $transactionType = 'pay';  // Default value

    public $accounts;
    public $blocks;
    public $all_tokens;
    public $nextToken;
    public $page;
    public $limit = 25;

    public function mount($type)
    {
        $this->algorand_service = new AlgorandService();
        $this->all_tokens = collect();
        $this->page = 1;

        if ($type == 'transactions') {
            $this->getTransactions('init');
        } elseif ($type == 'accounts') {
            $this->getAccounts('init');
        } elseif ($type == 'blocks') {
            $this->getBlocks('init');
        }

    }

    public function render()
    {
        $view = $this->getView();
        $viewVars = [
            'transactions' => $this->transactions,
            'accounts' => $this->accounts,
            'blocks' => $this->blocks,
            'page' => $this->page
        ];
        return view($view, $viewVars);
    }

    public function getTransactions($action, $type = null)
    {
        $this->transactionType = $type ?? $this->transactionType;
        $this->algorand_service = new AlgorandService();
        if ($action == 'next') {
            $data = $this->algorand_service->fetchTransactions(['next' => $this->nextToken, 'limit' => $this->limit, 'tx-type' => $this->transactionType]);
            $this->all_tokens->push($data['next-token']);
            $this->page++;
        } elseif ($action == 'prev' && $this->page > 2) {
            $this->all_tokens->pop();
            $next = $this->all_tokens->last();
            $data = $this->algorand_service->fetchTransactions(['next' => $next, 'limit' => $this->limit, 'tx-type' => $this->transactionType]);
            $this->page--;
        } else {
            $data = $this->algorand_service->fetchTransactions(['limit' => $this->limit, 'tx-type' => $this->transactionType]);
            $this->all_tokens->push($data['next-token']);
            $this->page = 1;
        }
        $this->nextToken = $data['next-token'];
        $this->transactions = $data['transactions'];
    }

    public function getAccounts($action)
    {
        $this->algorand_service = new AlgorandService();
        if ($action == 'next') {
            $data = $this->algorand_service->fetchAccounts(['next' => $this->nextToken, 'limit' => $this->limit]);
            $this->all_tokens->push($data['next-token']);
            $this->page++;
        } elseif ($action == 'prev' && $this->page > 2) {
            $this->all_tokens->pop();
            $next = $this->all_tokens->last();
            $data = $this->algorand_service->fetchAccounts(['next' => $next, 'limit' => $this->limit]);
            $this->page--;
        } else {
            $data = $this->algorand_service->fetchAccounts(['limit' => $this->limit]);
            $this->all_tokens->push($data['next-token']);
            $this->page = 1;
        }
        $this->nextToken = $data['next-token'];
        $this->accounts = $data['accounts'];
    }

    public function getBlocks($action)
    {
        $this->algorand_service = new AlgorandService();
        $round = 12345;
        $data = $this->algorand_service->fetchBlocks($round, ['next' => $this->nextToken, 'limit' => $this->limit]);
        dd($data);
        if ($action == 'next') {
            $data = $this->algorand_service->fetchBlocks(['next' => $this->nextToken, 'limit' => $this->limit], $round);
            $this->all_tokens->push($data['next-token']);
            $this->page++;
        } elseif ($action == 'prev' && $this->page > 2) {
            $this->all_tokens->pop();
            $next = $this->all_tokens->last();
            $data = $this->algorand_service->fetchBlocks(['next' => $next, 'limit' => $this->limit]);
            $this->page--;
        } else {
            $data = $this->algorand_service->fetchBlocks(['limit' => $this->limit]);
            dd($data);

            $this->all_tokens->push($data['next-token']);
            $this->page = 1;
        }

        $this->nextToken = $data['next-token'];
        $this->blocks = $data['blocks'];
    }

    public function getView()
    {
        $view = '';
        if (isset($this->transactions)) {
            $view = 'livewire.explorer.transactions';
        } elseif (isset($this->accounts)) {
            $view = 'livewire.explorer.accounts';
        } elseif (isset($this->blocks)) {
            $view = 'livewire.explorer.blocks';
        }
        return $view;
    }

    public function updatedTransactionType($value)
    {
        dd($value);
    }
}
