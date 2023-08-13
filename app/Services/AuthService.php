<?php

namespace App\Services;


use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService extends BaseService
{
    /**
     * @param $loginData
     * @return int[]
     */
    public function login($loginData): array
    {

        $user = User::where('card_number', $loginData['card_number'])->first();

        if (!$user || !$user->checkPin($loginData['pin'])) {
            return $this->failed('400', ['error' => 'Invalid Data', 1060]);
        }

        Auth::login($user);

        return $this->success(200, ['message' => 'Welcome Back']);
    }

    public function logout(): array
    {
        Auth::logout();
        return $this->success(200, ['message' => 'successfully logout']);
    }

}
