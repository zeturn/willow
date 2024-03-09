<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TokenGenerator extends Component
{
    public $token = '';

    public function generateToken()
    {

        $user = Auth::user();

        $tokenResult =$user->createToken('Personal Access Token');

        $this->token =$tokenResult->token;

        // 如果需要，可以保存令牌到数据库
        if ($this->token->save()) {
            return response()->json([
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',//Bearer
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString(),
            ]);
        } else {
            return response()->json(['error' => 'Could not create token'], 500);
        }

    }

    public function render()
    {
        return view('livewire.token-generator');
    }
}
