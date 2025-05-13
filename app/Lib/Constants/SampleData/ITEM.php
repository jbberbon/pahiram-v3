<?php

namespace App\Lib\Constants\SampleData;

use App\Lib\Constants\Statuses\ITEM_STATUS;
use App\Models\Department;
use App\Models\ItemGroup;
use App\Models\ItemStatus;
use App\Lib\Constants\DEPARTMENT as DEPARTMENT_CONST;
use App\Lib\Constants\SampleData\ITEM_GROUP as ITEM_GROUP_CONST;
use App\Lib\Constants\Statuses\ITEM_STATUS as ITEM_STATUS_CONST;



class ITEM
{
    private static $itemStatusArray;

    private static $itemGroupsArray;
    private static $departmentsArray;

    public static function initialize()
    {
        // Only run the pluck query once to populate the static properties
        if (!self::$itemStatusArray || !self::$itemGroupsArray || !self::$departmentsArray) {
            self::$itemStatusArray = ItemStatus::pluck('id', 'item_status')->toArray();
            self::$itemGroupsArray = ItemGroup::pluck('id', 'model_name')->toArray();
            self::$departmentsArray = Department::pluck('id', 'shorthand_name')->toArray();
        }
    }


    public static function getItemsArray()
    {
        self::initialize();

        return [
            // Canon
            [
                'apc_item_id' => '000001',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP_CONST::CANON],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS_CONST::ACTIVE],
                'is_required_supervisor_approval' => true,
                'is_borrowable' => true,
                'department_id' => self::$departmentsArray[DEPARTMENT_CONST::ITRO],
            ],

            [
                'apc_item_id' => '000011',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP_CONST::CANON],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS_CONST::ACTIVE],
                'is_required_supervisor_approval' => true,
                'is_borrowable' => true,
                'department_id' => self::$departmentsArray[DEPARTMENT_CONST::ITRO],
            ],
            [
                'apc_item_id' => '000002',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP_CONST::CANON],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS_CONST::ACTIVE],
                'is_required_supervisor_approval' => true,
                'is_borrowable' => true,
                'department_id' => self::$departmentsArray[DEPARTMENT_CONST::ITRO],
            ],
            [
                'apc_item_id' => '000022',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP_CONST::CANON],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS_CONST::BEYOND_REPAIR],
                'is_required_supervisor_approval' => true,
                'is_borrowable' => true,
                'department_id' => self::$departmentsArray[DEPARTMENT_CONST::ITRO],
            ],
            // Macbook
            [
                'apc_item_id' => '000003',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP_CONST::MACBOOK],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS_CONST::ACTIVE],
                'is_required_supervisor_approval' => true,
                'is_borrowable' => true,
                'department_id' => self::$departmentsArray[DEPARTMENT_CONST::ITRO],
            ],
            [
                'apc_item_id' => '000033',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP_CONST::MACBOOK],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS_CONST::ACTIVE],
                'is_required_supervisor_approval' => true,
                'is_borrowable' => true,
                'department_id' => self::$departmentsArray[DEPARTMENT_CONST::ITRO],
            ],
            [
                'apc_item_id' => '000004',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP_CONST::MACBOOK],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS_CONST::DECOMMISSIONED],
                'is_required_supervisor_approval' => true,
                'is_borrowable' => true,
                'department_id' => self::$departmentsArray[DEPARTMENT_CONST::ITRO],
            ],
            [
                'apc_item_id' => '000044',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP_CONST::MACBOOK],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS_CONST::FOR_REPAIR],
                'is_required_supervisor_approval' => true,
                'is_borrowable' => true,
                'department_id' => self::$departmentsArray[DEPARTMENT_CONST::ITRO],
            ],

            // Arduino
            [
                'apc_item_id' => '000005',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP_CONST::ARDUINO],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS_CONST::ACTIVE],
                'is_required_supervisor_approval' => true,
                'is_borrowable' => true,
                'department_id' => self::$departmentsArray[DEPARTMENT_CONST::ITRO],
            ],
            [
                'apc_item_id' => '000055',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP_CONST::ARDUINO],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS_CONST::ACTIVE],
                'is_required_supervisor_approval' => true,
                'is_borrowable' => true,
                'department_id' => self::$departmentsArray[DEPARTMENT_CONST::ITRO],
            ],
            [
                'apc_item_id' => '000006',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP_CONST::ARDUINO],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS_CONST::ACTIVE],
                'is_required_supervisor_approval' => true,
                'is_borrowable' => true,
                'department_id' => self::$departmentsArray[DEPARTMENT_CONST::ITRO],
            ],
            [
                'apc_item_id' => '000066',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP_CONST::ARDUINO],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS_CONST::ACTIVE],
                'is_required_supervisor_approval' => true,
                'is_borrowable' => true,
                'department_id' => self::$departmentsArray[DEPARTMENT_CONST::ITRO],
            ],

            // BMO
            // Spalding
            [
                'apc_item_id' => '000007',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP_CONST::SPALDING],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS_CONST::ACTIVE],
                'is_required_supervisor_approval' => false,
                'is_borrowable' => true,
                'department_id' => self::$departmentsArray[DEPARTMENT_CONST::BMO],
            ],
            [
                'apc_item_id' => '000077',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP_CONST::SPALDING],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS_CONST::ACTIVE],
                'is_required_supervisor_approval' => false,
                'is_borrowable' => true,
                'department_id' => self::$departmentsArray[DEPARTMENT_CONST::BMO],
            ],
            [
                'apc_item_id' => '000008',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP_CONST::SPALDING],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS_CONST::ACTIVE],
                'is_required_supervisor_approval' => false,
                'department_id' => self::$departmentsArray[DEPARTMENT_CONST::BMO],
            ],
            [
                'apc_item_id' => '000088',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP_CONST::SPALDING],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS_CONST::DESIGNATED],
                'is_required_supervisor_approval' => false,
                'is_borrowable' => true,
                'department_id' => self::$departmentsArray[DEPARTMENT_CONST::BMO],
            ],

            // Lifetime
            [
                'apc_item_id' => '000009',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP_CONST::LIFETIME],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS_CONST::ACTIVE],
                'is_required_supervisor_approval' => false,
                'is_borrowable' => true,
                'department_id' => self::$departmentsArray[DEPARTMENT_CONST::BMO],
            ],
            [
                'apc_item_id' => '000099',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP_CONST::LIFETIME],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS_CONST::ACTIVE],
                'is_required_supervisor_approval' => false,
                'is_borrowable' => true,
                'department_id' => self::$departmentsArray[DEPARTMENT_CONST::BMO],
            ],
            [
                'apc_item_id' => '100000',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP_CONST::LIFETIME],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS_CONST::ACTIVE],
                'is_required_supervisor_approval' => false,
                'is_borrowable' => true,
                'department_id' => self::$departmentsArray[DEPARTMENT_CONST::BMO],
            ],
            [
                'apc_item_id' => '110000',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP_CONST::LIFETIME],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS_CONST::ACTIVE],
                'is_required_supervisor_approval' => false,
                'is_borrowable' => true,
                'department_id' => self::$departmentsArray[DEPARTMENT_CONST::BMO],
            ],

            // JBL
            [
                'apc_item_id' => '200000',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP_CONST::JBL],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS_CONST::ACTIVE],
                'is_required_supervisor_approval' => false,
                'is_borrowable' => true,
                'department_id' => self::$departmentsArray[DEPARTMENT_CONST::BMO],
            ],
            [
                'apc_item_id' => '220000',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP_CONST::JBL],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS_CONST::ACTIVE],
                'is_required_supervisor_approval' => false,
                'is_borrowable' => true,
                'department_id' => self::$departmentsArray[DEPARTMENT_CONST::BMO],
            ],
            [
                'apc_item_id' => '300000',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP_CONST::JBL],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS_CONST::ACTIVE],
                'is_required_supervisor_approval' => false,
                'is_borrowable' => true,
                'department_id' => self::$departmentsArray[DEPARTMENT_CONST::BMO],
            ],
            [
                'apc_item_id' => '330000',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP_CONST::JBL],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS_CONST::ACTIVE],
                'is_required_supervisor_approval' => false,
                'is_borrowable' => true,
                'department_id' => self::$departmentsArray[DEPARTMENT_CONST::BMO],
            ],

            // Eslo
            // Microscope
            [
                'apc_item_id' => '400000',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP_CONST::MICRON],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS_CONST::ACTIVE],
                'is_required_supervisor_approval' => true,
                'is_borrowable' => true,
                'department_id' => self::$departmentsArray[DEPARTMENT_CONST::ESLO],
            ],
            [
                'apc_item_id' => '440000',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP_CONST::MICRON],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS_CONST::ACTIVE],
                'is_required_supervisor_approval' => true,
                'is_borrowable' => true,
                'department_id' => self::$departmentsArray[DEPARTMENT_CONST::ESLO],
            ],
            [
                'apc_item_id' => '500000',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP_CONST::MICRON],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS_CONST::ACTIVE],
                'is_required_supervisor_approval' => true,
                'is_borrowable' => true,
                'department_id' => self::$departmentsArray[DEPARTMENT_CONST::ESLO],
            ],

            // 3d Printer
            [
                'apc_item_id' => '550000',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP_CONST::REPLICATOR],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS_CONST::ACTIVE],
                'is_required_supervisor_approval' => true,
                'is_borrowable' => true,
                'department_id' => self::$departmentsArray[DEPARTMENT_CONST::ESLO],
            ],
            [
                'apc_item_id' => '600000',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP_CONST::REPLICATOR],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS_CONST::ACTIVE],
                'is_required_supervisor_approval' => true,
                'is_borrowable' => true,
                'department_id' => self::$departmentsArray[DEPARTMENT_CONST::ESLO],
            ],
            [
                'apc_item_id' => '660000',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP_CONST::REPLICATOR],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS_CONST::LOST],
                'is_required_supervisor_approval' => true,
                'is_borrowable' => true,
                'department_id' => self::$departmentsArray[DEPARTMENT_CONST::ESLO],
            ],

            // Voltage Tester
            [
                'apc_item_id' => '700000',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP_CONST::FLUKE],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS_CONST::ACTIVE],
                'is_required_supervisor_approval' => true,
                'is_borrowable' => true,
                'department_id' => self::$departmentsArray[DEPARTMENT_CONST::ESLO],
            ],
            [
                'apc_item_id' => '770000',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP_CONST::FLUKE],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS_CONST::ACTIVE],
                'is_required_supervisor_approval' => true,
                'is_borrowable' => true,
                'department_id' => self::$departmentsArray[DEPARTMENT_CONST::ESLO],
            ],
            [
                'apc_item_id' => '800000',
                'item_group_id' => self::$itemGroupsArray[ITEM_GROUP_CONST::FLUKE],
                'item_status_id' => self::$itemStatusArray[ITEM_STATUS_CONST::ACTIVE],
                'is_required_supervisor_approval' => true,
                'is_borrowable' => true,
                'department_id' => self::$departmentsArray[DEPARTMENT_CONST::ESLO],
            ],

        ];
    }
}