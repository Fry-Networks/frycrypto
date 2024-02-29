<?php

namespace App\Livewire\Dashboard;

use App\Models\Transaction;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Transactions extends Component
{
    use WithPagination;
    public $date;
    public $timestamp;
    public $note;

    public $transactionType = 'axfer';

    function mount($note)
    {
        $this->note = $note;
    }

    public function render()
    {
        $this->transactionType = $type ?? $this->transactionType;
        return view('livewire.dashboard.transactions' , [
            'transactions' => $this->getTransactions($this->note, $this->date, $this->transactionType),
        ]);
    }

    public function updatedDate($value)
    {
        $this->date = $value;
    }

    private function getTransactions($note, $date, mixed $transactionType)
    {
        $start = $end = null;
        if($date != null){
            $start = Carbon::parse($date)->startOfDay()->timestamp;
            $end = Carbon::parse($date)->endOfDay()->timestamp;
        };
        return Transaction::query()
            ->where('note', $note)
            ->where('tx_type', $transactionType)
            ->orderByDesc('round_time')
            ->when($date, function ($query) use ($start, $end) {
                return $query->whereBetween('round_time', [$start, $end]);
            })
            ->paginate(15);
    }


}
