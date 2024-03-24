<?php

namespace App\Livewire\VerifyEmail;

use Livewire\Component;

class DoubleHashedVerification extends Component
{
    public $value;
    public function render()
    {
        return view('livewire.verify-email.double-hashed-verification');
    }
}
