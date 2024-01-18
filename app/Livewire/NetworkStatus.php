<?php

namespace App\Livewire;

use Livewire\Component;

class NetworkStatus extends Component
{
    public $isOnline;

    public function mount()
    {
        $this->isOnline = true; // 默认为在线
    }

    public function render()
    {
        return view('livewire.network-status', ['isOnline' => $this->isOnline]);
    }
}
