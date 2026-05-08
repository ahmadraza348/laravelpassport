<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Helper\ApiResponse;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthLogin;
use App\Http\Requests\AuthRegister;
use App\Services\AuthService;

class AuthController extends Controller
{
    public function __construct(
        protected AuthService $authService
    ) {}

    public function register(AuthRegister $request)
    {
        try {

            $user = $this->authService->register(
                $request->validated()
            );

            return ApiResponse::success(
                self::SUCCESS_MESSAGE,
                $user,
                201
            );

        } catch (Exception $e) {

            Log::error('Register Error: '.$e->getMessage());

            return ApiResponse::error(
                self::EXCEPTION_MESSAGE,
                [],
                500
            );
        }
    }

    public function login(AuthLogin $request)
    {
        try {

            $response = $this->authService->login(
                $request->validated()
            );

            if (!$response) {
                return ApiResponse::error(
                    self::INVALID_CREDENTIALS,
                    [],
                    401
                );
            }

            return ApiResponse::success(
                self::SUCCESS_MESSAGE,
                $response
            );

        } catch (Exception $e) {

            Log::error('Login Error: '.$e->getMessage());

            return ApiResponse::error(
                self::EXCEPTION_MESSAGE,
                [],
                500
            );
        }
    }
}