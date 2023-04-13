<?php

namespace App\Services\Auth;

use App\Repositories\Interfaces\IUserRepository;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

 /*
 * Class RegisterService
 * @package App\Services
 */
class RegisterService
{   
    protected IUserRepository $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(array $data): array {
        $data['password'] = Hash::make($data['password']);

        $user = $this->userRepository->create($data);

        $token = $user->createToken('apiToken')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token
        ];
    }
}
