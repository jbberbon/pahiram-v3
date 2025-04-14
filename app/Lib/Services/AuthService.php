<?php

namespace App\Lib\Services;

use App\Lib\DTOs\Auth\ApcisLoginResponseDto;
use App\Lib\DTOs\Auth\ApcisTokenDto;
use App\Lib\DTOs\Auth\ApcisUserDto;
use App\Lib\DTOs\Auth\UserCredentialDto;
use App\Lib\Interfaces\Services\AuthServiceInterface;
use Illuminate\Support\Facades\Http;

class AuthService implements AuthServiceInterface
{
    private string $apcisBaseUrl;
    private string $apcisLoginUrl;

    public function __construct()
    {
        $this->apcisBaseUrl = env('APCIS_URL');
        $this->apcisLoginUrl = env('APCIS_LOGIN');
    }

    public function handleApcisLogin(UserCredentialDto $credentials): ApcisLoginResponseDto
    {
        try {
            $loginResponse = new ApcisLoginResponseDto();

            // 01. Make the HTTP request to the APCIS login endpoint
            $loginUrl = "{$this->apcisBaseUrl}{$this->apcisLoginUrl}";
            $response = Http::timeout(10)
                ->post($loginUrl, $credentials->toArray());

            // 02. Decode and extract the response data
            $responseData = json_decode($response->body(), true);
            $userField = $responseData['user'] ?? null;
            $tokenField = $responseData['apcisToken'] ?? null;

            // 03. Check if the response is successful
            if ($response->successful() && $userField && $tokenField) {
                // 05. Return Success
                $loginResponse->isSuccess = true;
                $loginResponse->user =  ApcisUserDto::fromArray($userField);
                $loginResponse->token = ApcisTokenDto::fromArray($tokenField);
                return $loginResponse;
            }

            // 06. Handle unsuccessful response
            $loginResponse->isSuccess = false;
            $loginResponse->httpErrorCode = $response->status();
            return $loginResponse;

        } catch (\Exception $e) {
            // 07. Handle exceptions
            $loginResponse->isSuccess = false;
            $loginResponse->httpErrorCode = 500; // Internal Server Error
            return $loginResponse;
        }
    }
}