<?php

namespace App\Lib\Constants\SampleData;

use App\Lib\Constants\Statuses\ITEM_STATUS;
use App\Models\ItemGroup;
use App\Models\ItemStatus;

class ITEM
{
    private static $itemStatusArray;

    private static $itemGroupsArray;

    public static function initialize()
    {
        // Only run the pluck query once to populate the static properties
        if (!self::$itemStatusArray || !self::$itemGroupsArray) {
            self::$itemStatusArray = ItemStatus::pluck('id', 'item_status')->toArray();
            self::$itemGroupsArray = ItemGroup::pluck('id', 'model_name')->toArray();
        }
    }


    public static function getItemsArray()
    {
        self::initialize();

        return [
            // Canon
            [
                'apc_item_id' => '000001',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP::CANON],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS::ACTIVE],
                'is_required_supervisor_approval' => true,
            ],

            [
                'apc_item_id' => '000011',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP::CANON],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS::ACTIVE],
                'is_required_supervisor_approval' => true,
            ],
            [
                'apc_item_id' => '000002',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP::CANON],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS::ACTIVE],
                'is_required_supervisor_approval' => true,
            ],
            [
                'apc_item_id' => '000022',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP::CANON],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS::BEYOND_REPAIR],
                'is_required_supervisor_approval' => true,
            ],
            // Macbook
            [
                'apc_item_id' => '000003',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP::MACBOOK],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS::ACTIVE],
                'is_required_supervisor_approval' => true,
            ],
            [
                'apc_item_id' => '000033',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP::MACBOOK],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS::ACTIVE],
                'is_required_supervisor_approval' => true,
            ],
            [
                'apc_item_id' => '000004',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP::MACBOOK],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS::DECOMMISSIONED],
                'is_required_supervisor_approval' => true,
            ],
            [
                'apc_item_id' => '000044',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP::MACBOOK],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS::FOR_REPAIR],
                'is_required_supervisor_approval' => true,
            ],

            // Arduino
            [
                'apc_item_id' => '000005',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP::ARDUINO],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS::ACTIVE],
                'is_required_supervisor_approval' => true,
            ],
            [
                'apc_item_id' => '000055',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP::ARDUINO],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS::ACTIVE],
                'is_required_supervisor_approval' => true,
            ],
            [
                'apc_item_id' => '000006',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP::ARDUINO],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS::ACTIVE],
                'is_required_supervisor_approval' => true,
            ],
            [
                'apc_item_id' => '000066',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP::ARDUINO],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS::ACTIVE],
                'is_required_supervisor_approval' => true,
            ],

            // BMO
            // Spalding
            [
                'apc_item_id' => '000007',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP::SPALDING],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS::ACTIVE],
                'is_required_supervisor_approval' => false,
            ],
            [
                'apc_item_id' => '000077',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP::SPALDING],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS::ACTIVE],
                'is_required_supervisor_approval' => false,
            ],
            [
                'apc_item_id' => '000008',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP::SPALDING],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS::ACTIVE],
                'is_required_supervisor_approval' => false,
            ],
            [
                'apc_item_id' => '000088',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP::SPALDING],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS::DESIGNATED],
                'is_required_supervisor_approval' => false,
            ],

            // Lifetime
            [
                'apc_item_id' => '000009',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP::LIFETIME],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS::ACTIVE],
                'is_required_supervisor_approval' => false,
            ],
            [
                'apc_item_id' => '000099',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP::LIFETIME],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS::ACTIVE],
                'is_required_supervisor_approval' => false,
            ],
            [
                'apc_item_id' => '100000',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP::LIFETIME],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS::ACTIVE],
                'is_required_supervisor_approval' => false,
            ],
            [
                'apc_item_id' => '110000',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP::LIFETIME],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS::ACTIVE],
                'is_required_supervisor_approval' => false,
            ],

            // JBL
            [
                'apc_item_id' => '200000',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP::JBL],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS::ACTIVE],
                'is_required_supervisor_approval' => false,
            ],
            [
                'apc_item_id' => '220000',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP::JBL],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS::ACTIVE],
                'is_required_supervisor_approval' => false,
            ],
            [
                'apc_item_id' => '300000',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP::JBL],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS::ACTIVE],
                'is_required_supervisor_approval' => false,
            ],
            [
                'apc_item_id' => '330000',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP::JBL],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS::ACTIVE],
                'is_required_supervisor_approval' => false,
            ],

            // Eslo
            // Microscope
            [
                'apc_item_id' => '400000',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP::MICRON],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS::ACTIVE],
                'is_required_supervisor_approval' => true,
            ],
            [
                'apc_item_id' => '440000',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP::MICRON],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS::ACTIVE],
                'is_required_supervisor_approval' => true,
            ],
            [
                'apc_item_id' => '500000',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP::MICRON],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS::ACTIVE],
                'is_required_supervisor_approval' => true,
            ],

            // 3d Printer
            [
                'apc_item_id' => '550000',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP::REPLICATOR],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS::ACTIVE],
                'is_required_supervisor_approval' => true,
            ],
            [
                'apc_item_id' => '600000',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP::REPLICATOR],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS::ACTIVE],
                'is_required_supervisor_approval' => true,
            ],
            [
                'apc_item_id' => '660000',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP::REPLICATOR],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS::LOST],
                'is_required_supervisor_approval' => true,
            ],

            // Voltage Tester
            [
                'apc_item_id' => '700000',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP::FLUKE],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS::ACTIVE],
                'is_required_supervisor_approval' => true,
            ],
            [
                'apc_item_id' => '770000',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP::FLUKE],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS::ACTIVE],
                'is_required_supervisor_approval' => true,
            ],
            [
                'apc_item_id' => '800000',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP::FLUKE],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS::ACTIVE],
                'is_required_supervisor_approval' => true,
            ],

        ];
    }
}