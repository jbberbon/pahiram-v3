<?php

namespace App\Lib\Constants\SampleData;

class ITEM_GROUP_CATEGORY
{
    public const CAMERA = 'CAMERA';
    public const LAPTOP = 'LAPTOP';
    public const BALL = 'BALL';
    public const TABLE = 'TABLE';
    public const MICROSCOPE = 'MICROSCOPE';
    public const PRINTER = '3D_PRINTER';
    public const MICROCONTROLLER = 'MICROCONTROLLER';
    public const SPEAKER = 'SPEAKER';
    public const VOLTAGE_TESTER = 'VOLTAGE_TESTER';
    public const LAN_CABLING_TOOL = 'LAN_CABLING_TOOL';
    public const PAPER = 'PAPER';
    public const PENS = 'PENS';
    public const PENCIL = 'PENCIL';


    public const ITEM_GROUP_CATEGORY_ARRAY = [
        ['name' => self::CAMERA, 'is_consumable' => false],
        ['name' => self::LAPTOP, 'is_consumable' => false],
        ['name' => self::BALL, 'is_consumable' => false],
        ['name' => self::TABLE, 'is_consumable' => false],
        ['name' => self::MICROSCOPE, 'is_consumable' => false],
        ['name' => self::PRINTER, 'is_consumable' => false],
        ['name' => self::MICROCONTROLLER, 'is_consumable' => false],
        ['name' => self::SPEAKER, 'is_consumable' => false],
        ['name' => self::VOLTAGE_TESTER, 'is_consumable' => false],
        ['name' => self::LAN_CABLING_TOOL, 'is_consumable' => false],
        ['name' => self::PAPER, 'is_consumable' => true],
        ['name' => self::PENS, 'is_consumable' => true],
        ['name' => self::PENCIL, 'is_consumable' => true],
    ];
}