<?php

namespace App\Livewire\Dashboard;

use App\Models\Transaction;
use Livewire\Component;
use Livewire\WithPagination;

class Transactions extends Component
{
    use WithPagination;

    public $transactionType = 'axfer';

    public function render()
    {
        $this->transactionType = $type ?? $this->transactionType;
        return view('livewire.dashboard.transactions' , [
            'transactions' => Transaction::query()->where('tx_type', $this->transactionType)->paginate(25)
        ]);
    }


}
