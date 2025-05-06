<?php

namespace Database\Seeders;

use App\Lib\Constants\SampleData\ITEM_GROUP;
use App\Lib\Constants\SampleData\ITEM_GROUP_CATEGORY;
use App\Lib\Constants\SampleData\ITEM as ITEM_CONST;
use App\Lib\Constants\Statuses\ACCOUNT_STATUS;
use App\Lib\Constants\ROLE as ROLE_CONST;
use App\Lib\Constants\DEPARTMENT as DEPARTMENT_CONST;
use App\Lib\Constants\Statuses\ITEM_STATUS;
use App\Models\AccountStatus;
use App\Models\Department;
use App\Models\Item;
use App\Models\ItemGroup;
use App\Models\ItemGroupCategory;
use App\Models\ItemStatus;
use App\Models\Role;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Roles
        Role::factory()->createMany(ROLE_CONST::ROLE_ARRAY);

        // Departments
        Department::factory()->createMany(DEPARTMENT_CONST::DEPARTMENT_ARRAY);

        // Statuses
        AccountStatus::factory()->createMany(ACCOUNT_STATUS::STATUS_ARRAY);
        ItemStatus::factory()->createMany(ITEM_STATUS::ITEM_STATUS_ARRAY);


        // !!! Sample Data :: Remove for Prod
        ItemGroupCategory::factory()->createMany(ITEM_GROUP_CATEGORY::ITEM_GROUP_CATEGORY_ARRAY);
        ItemGroup::factory()->createMany(ITEM_GROUP::getItemGroupArray());
        Item::factory()->createMany(ITEM_CONST::getItemsArray());

    }
}
