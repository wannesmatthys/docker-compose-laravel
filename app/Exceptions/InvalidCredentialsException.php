<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;

class InvalidCredentialsException extends AuthenticationException
{
    /**
     * Create a new exception instance.
     *
     * @param string $message
     * @param array $guards
     * @return void
     */
    public function __construct($message = 'Invalid email or password', $guards = [])
    {
        parent::__construct($message, $guards);
    }
}