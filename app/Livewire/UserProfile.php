<?php

// app/Http/Livewire/UserProfile.php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class UserProfile extends Component
{
    public $user;

    public function mount($userId)
    {
        $this->user = User::findOrFail($userId);
    }

    public function render()
    {
        return view('livewire.user-profile');
    }
}
