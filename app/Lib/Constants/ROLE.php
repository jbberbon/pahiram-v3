<?php

namespace App\Lib\Constants;

class ROLE
{
    public const SUPERVISOR = 'SUPERVISOR';
    public const COSUPERVISOR = 'COSUPERVISOR';
    public const PENALTY_MANAGER = 'PENALTY_MANAGER';
    public const LENDING_EMPLOYEE = 'LENDING_EMPLOYEE';
    public const INVENTORY_MANAGER = 'INVENTORY_MANAGER';

    public const ROLE_ARRAY = [
        [
            'name' => self::LENDING_EMPLOYEE,
            'description' => 'An employee within a lending office'
        ],
        [
            'name' => self::INVENTORY_MANAGER,
            'description' => 'Manages inventory'
        ],
        [
            'name' => self::PENALTY_MANAGER,
            'description' => 'Manages borrowing panalties'
        ],
        [
            'name' => self::COSUPERVISOR,
            'description' => 'Alter ego of Supervisor but cannot designate office names'
        ],
        [
            'name' => self::SUPERVISOR,
            'description' => 'Head of the designated office'
        ],
        // January 30, 2024
        // NO need, Endorsers for now are identified using their @apc.edu.ph email
        // [
        //     'name' => 'ENDORSER',
        //     'description' => 'Borrowing Endorser'
        // ],
    ];
}