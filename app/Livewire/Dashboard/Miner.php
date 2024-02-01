<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class Miner extends Component
{
    public $loop;
    public $miner;

    public function mount($miner, $loop)
    {
        $this->miner = $miner;
        $this->loop = $loop;
    }

    public function render()
    {
        return view('livewire.dashboard.miner');
    }
}
