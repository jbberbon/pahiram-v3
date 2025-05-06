<?php

namespace App\Lib\Constants\Statuses;

class ACCOUNT_STATUS
{
    public const ACTIVE = 'ACTIVE';
    public const DEACTIVATED = 'DEACTIVATED';
    public const SUSPENDED = 'SUSPENDED';

    public const STATUS_ARRAY = [
        [
            'status' => self::ACTIVE,
            'description' => 'The account is in good standing'
        ],
        [
            'status' => self::DEACTIVATED,
            'description' => 'The person is either have not enrolled yet or no longer affiliated with the school'
        ],
        [
            'status' => self::SUSPENDED,
            'description' => 'The account needs to address outstanding penalties / issues'
        ],
    ];
}