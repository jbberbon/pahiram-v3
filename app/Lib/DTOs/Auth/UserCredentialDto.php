<?php

namespace App\Lib\DTOs\Auth;

use App\Http\Requests\Auth\LoginRequest;

class UserCredentialDto
{
    public function __construct(
        public string $email,
        public string $password,
    ) {}


    public static function fromRequest(LoginRequest $request): self
    {
        return new self(
            $request->email,
            $request->password
        );
    }

    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password,

            // TODO: Remove later OR implement full auth flow logic
            'rememberMe' => false
        ];
    }
}