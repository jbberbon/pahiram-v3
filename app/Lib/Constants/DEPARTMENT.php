<?php

namespace App\Lib\Constants;

class DEPARTMENT
{
    public const BMO = 'BMO';
    public const ESLO = 'ESLO';
    public const ITRO = 'ITRO';

    public const FAO = 'FAO';
    public const PLO = 'PLO';


    public const DEPARTMENT_ARRAY = [
        [
            "shorthand_name" => self::BMO,
            "name" => "Buidling Maintenance Office",
            "is_lending_office" => true,
        ],
        [
            "shorthand_name" => self::ESLO,
            "name" => "Engineering and Science Laboratory Office",
            "is_lending_office" => true,
        ],
        [
            "shorthand_name" => self::ITRO,
            "name" => "Information Technology and Resource Office",
            "is_lending_office" => true,
        ],

        // Non Lending Offices
        [
            "shorthand_name" => self::PLO,
            "name" => "Purchasing and Logistics Office",
            "is_lending_office" => false
        ],
        [
            "shorthand_name" => self::FAO,
            "name" => "Finance and Accounting Office",
            "is_lending_office" => false
        ]
    ];

    public const LENDING_OFFICES = [
        self::BMO,
        self::ESLO,
        self::ITRO
    ];  

    // public static function getOfficeAcronymFromOfficeConstant(string $officeAcronym)
    // {
    //     return self::OFFICE_ARRAY[$officeAcronym]['department_acronym'] ?? null;
    // }
}