<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Http\Requests\Auth\LoginRequest;
use App\Exceptions\InvalidCredentialsException;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\IUserRepository;

/**
 * Class LoginService
 * @package App\Services
*/  
class LoginService
{   
    protected IUserRepository $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function loginWithEmail(array $credentials): array {
        if (!Auth::attempt($credentials)) {
            throw new InvalidCredentialsException();
        }
        
        $user = $this->userRepository->findByEmail($credentials['email']);
        $token = $user->createToken('apiToken')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token
        ];
    }
    
}
