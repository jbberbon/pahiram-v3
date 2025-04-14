<?php

namespace App\Lib\DTOs\Auth;

class ApcisUserDto {
    public ?string $firstName = null;
    public ?string $lastName = null;
    public ?string $email = null;
    public ?string $apcId = null;

    public function __construct(
        ?string $firstName = null,
        ?string $lastName = null,
        ?string $email = null,
        ?string $apcId = null
    ) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->apcId = $apcId;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['firstName'] ?? null,
            $data['lastName'] ?? null,
            $data['email'] ?? null,
            $data['apcId'] ?? null
        );
    }

    public function toArray(): array
    {
        return [
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'email' => $this->email,
            'apcId' => $this->apcId
        ];
    }

    public function toUserModelArray(): array
    {
        return [
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'apc_id' => $this->apcId
        ];
    }
}