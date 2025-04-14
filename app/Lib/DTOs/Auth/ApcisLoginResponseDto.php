<?php

namespace App\Lib\DTOs\Auth;

class ApcisLoginResponseDto
{
    public function __construct(
        public bool $isSuccess = false,
        public int $httpErrorCode = 0,

        public ApcisUserDto $user = new ApcisUserDto(),
        public ApcisTokenDto $apcisToken = new ApcisTokenDto(),
    ) {}
}