<?php

namespace App\Lib\Interfaces\Services;

use App\Lib\DTOs\Auth\ApcisLoginResponseDto;
use App\Lib\DTOs\Auth\UserCredentialDto;

interface AuthServiceInterface {
    public function handleApcisLogin(UserCredentialDto $params): ApcisLoginResponseDto;
}