<?php

namespace App\Lib\Constants\Statuses;

class ITEM_STATUS
{
    public const ACTIVE = 'ACTIVE';
    public const DESIGNATED = 'DESIGNATED';
    public const FOR_REPAIR = 'FOR_REPAIR';
    public const BEYOND_REPAIR = 'BEYOND_REPAIR';
    public const DECOMMISSIONED = 'DECOMMISSIONED';
    public const LOST = 'LOST';
    public const UNRETURNED = 'UNRETURNED';


    public const ITEM_STATUS_ARRAY = [
        [
            "item_status" => self::ACTIVE,
            "description" => "Item is in circulation",
        ],
        [
            "item_status" => self::DESIGNATED,
            "description" => "Not borrowed but item is currently deployed to an APC employee",
        ],
        [
            "item_status" => self::FOR_REPAIR,
            "description" => "Item is damaged thus, for repair",
        ],
        [
            "item_status" => self::BEYOND_REPAIR,
            "description" => "Item is unfixable",
        ],
        [
            "item_status" => self::DECOMMISSIONED,
            "description" => "Item retired due to age",
        ],
        [
            "item_status" => self::LOST,
            "description" => "Item is lost",
        ],
        [
            "item_status" => self::UNRETURNED,
            "description" => "Item is unreturned by borrower or designated personnel",
        ],
    ];
}