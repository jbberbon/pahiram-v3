<?php

namespace App\Lib\DTOs\Auth;

class ApcisTokenDto {
    public ?string $accessToken = null;
    public ?string $expiresAt = null;

    public function __construct(
        ?string $accessToken = null,
        ?string $expiresAt = null
    ) {
        $this->accessToken = $accessToken;
        $this->expiresAt = $expiresAt;
    }


    public static function fromArray(array $data): self
    {
        return new self(
            $data['accessToken'] ?? null,
            $data['expiresAt'] ?? null,
        );
    }
}