<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\User; // 引入User模型

class UserNameAndAvatar extends Component
{
    public $user;

    public function __construct($userId)
    {
        $this->user = User::find($userId);
        // Log::info('User data', ['user' => $this->user]);
    }

    public function render()
    {
        return view('components.user-name-and-avatar');
    }
}
