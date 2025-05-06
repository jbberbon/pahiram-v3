<?php

namespace App\Lib\Constants\SampleData;

use App\Models\Department;
use App\Lib\Constants\DEPARTMENT as DEPARTMENT_CONST;
use App\Models\ItemGroupCategory;

class ITEM_GROUP
{
    public const CANON = 'Canon 200d';
    public const MACBOOK = 'MacBook Air M1';
    public const ARDUINO = 'Arduino Uno R4 WiFi';
    public const SPALDING = 'Spalding FIBA 2007';
    public const LIFETIME = 'Lifetime 6ft Folding Table';
    public const JBL = 'JBL Quantum Duo Speaker';
    public const MICRON = 'Micron Cresta ZS Microscope';
    public const FLUKE = 'FLUKE T150 Voltage Tester';
    public const REPLICATOR = 'Replicator+ 3D Printer';


    public static function getItemGroupArray(): array
    {
        return [
            [
                'model_name' => self::CANON,
                'description' => 'A compact DSLR camera ideal for photography and video projects.',
                'group_category_id' => ItemGroupCategory::where('name', ITEM_GROUP_CATEGORY::CAMERA)->first()->id,
            ],
            [
                'model_name' => self::MACBOOK,
                'description' => 'Lightweight laptop with Apple Silicon for everyday computing tasks.',
                'group_category_id' => ItemGroupCategory::where('name', ITEM_GROUP_CATEGORY::LAPTOP)->first()->id,
            ],
            [
                'model_name' => self::ARDUINO,
                'description' => 'Microcontroller board with built-in WiFi for IoT projects.',
                'group_category_id' => ItemGroupCategory::where('name', ITEM_GROUP_CATEGORY::MICROCONTROLLER)->first()->id,
            ],
            [
                'model_name' => self::SPALDING,
                'description' => 'Official size basketball used in indoor court games.',
                'group_category_id' => ItemGroupCategory::where('name', ITEM_GROUP_CATEGORY::BALL)->first()->id,
            ],
            [
                'model_name' => self::LIFETIME,
                'description' => 'Durable folding table suitable for events and multi-purpose use.',
                'group_category_id' => ItemGroupCategory::where('name', ITEM_GROUP_CATEGORY::TABLE)->first()->id,
            ],
            [
                'model_name' => self::JBL,
                'description' => 'High-quality gaming speakers with dynamic lighting effects.',
                'group_category_id' => ItemGroupCategory::where('name', ITEM_GROUP_CATEGORY::SPEAKER)->first()->id,
            ],
            [
                'model_name' => self::MICRON,
                'description' => 'Advanced microscope for educational and research purposes.',
                'group_category_id' => ItemGroupCategory::where('name', ITEM_GROUP_CATEGORY::MICROSCOPE)->first()->id,
            ],
            [
                'model_name' => self::FLUKE,
                'description' => 'Reliable voltage tester for electrical troubleshooting.',
                'group_category_id' => ItemGroupCategory::where('name', ITEM_GROUP_CATEGORY::VOLTAGE_TESTER)->first()->id,
            ],
            [
                'model_name' => self::REPLICATOR,
                'description' => 'Desktop 3D printer designed for fast and precise prototyping.',
                'group_category_id' => ItemGroupCategory::where('name', ITEM_GROUP_CATEGORY::PRINTER)->first()->id,
            ],
        ];
    }
}