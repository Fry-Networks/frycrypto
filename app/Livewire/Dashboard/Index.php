<?php

namespace App\Livewire\Dashboard;

use App\Models\MinerDevices;
use App\Models\Transaction;
use Livewire\Component;

class Index extends Component
{
    public $miners = [];
    public $address = [];
    public $miners_count;
    public $verified_count;

    public function render()
    {
        return view('livewire.dashboard.index');
    }

    public function mount($address)
    {
        $this->address = $address;
        $this->loadMiners();
        $this->miners_count = count($this->miners);
        $this->verified_count = count(array_filter($this->miners, function ($miner) {
            return $miner['verified'];
        }));
    }

    public function loadMiners()
    {
        updateAllTransactionsOfAddress($this->address);
        $transactions = Transaction::where('sender', $this->address)->get();
        $miners = [];
        foreach ($transactions as $transaction) {
            $note = $transaction->note;
            $mac = substr($note, 23);
            $originalNote = $transaction->getAttributes()['note'];
            if ($mac && !isset($miners[$mac])) {
                $miners[$mac] = [
                    'address' => $mac,
                    'note' => $originalNote,
                    'on_boarding' => $transactions->min('round_time'),
                    'transactions' => getTransactionsByNote($originalNote),
                    'verified' => MinerDevices::query()->where('mac', $mac)->exists(),
                    'status' => $this->getMinerStatus($transactions->where('note', $originalNote)->max('round_time')),
                ];
            }
        }
        $this->miners = array_values($miners);
    }

    private function getMinerStatus($max)
    {
        $timeOnline = now()->subHours(2)->timestamp;
        $timePossibleOnline = now()->subHours(4)->timestamp;
        $timePossibleOffline = now()->subHours(12)->timestamp;
        if ($max < $timeOnline) {
            return 'online';
        } elseif ($max < $timePossibleOnline) {
            return 'possible online';
        } elseif ($max < $timePossibleOffline) {
            return 'possible offline';
        } else {
            return 'offline';
        }
    }

}
