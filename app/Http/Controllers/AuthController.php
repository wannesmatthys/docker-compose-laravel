<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Auth\LoginService;
use App\Services\Auth\RegisterService;
use App\Exceptions\InvalidCredentialsException;

class AuthController extends Controller
{
    protected LoginService $loginService;
    protected RegisterService $registerService;

    public function __construct(LoginService $loginService, RegisterService $registerService)
    {
        $this->loginService = $loginService;
        $this->registerService = $registerService;
    }

    public function login(LoginRequest $request): Response
    {
        $credentials = $request->validated();

        try {
            $user = $this->loginService->loginWithEmail($credentials);
        } catch (InvalidCredentialsException $e) {
            return response(['error' => $e->getMessage()], 401);
        }

        return response($user, 200);
    }

    public function register(RegisterRequest $request): Response
    {
        $data = $request->validated();

        $user = $this->registerService->register($data);

        return response($user, 201);
    }

}
