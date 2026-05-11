<?php

namespace App\Services;

use App\Repository\AuthRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function __construct(
        protected AuthRepository $authRepository
    ) {}

    public function register(array $data)
    {
        $data['password'] = Hash::make($data['password']);

        return $this->authRepository->registerUser($data);
    }

    public function login(array $data): array|bool
    {
        if (!Auth::attempt($data)) {
            return false;
        }

        $user = Auth::user();

        $token = $user->createToken('auth_token')->accessToken;

        return [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
            'token' => $token
        ];
    }

    public function userProfile()
    {
        return Auth::user();
    }

    public function userLogout()
    {
        $authUser = Auth::user();
        if ($authUser) {
            $authUser->token()->revoke();
            return true;
        }
        return false;
    }

    public function getAuthUser()
    {
        return Auth::user();
    }
}
