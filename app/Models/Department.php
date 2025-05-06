<?php

namespace App\Models;

use App\Traits\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory, UseUuid;

    protected $fillable = [
        'name',
        'shorthand_name',
        'is_lending_office'
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at'
    ];

    public static function getIdByAcronym($acronym)
    {
        $department = self::where('shorthand_name', $acronym)->first();

        return $department?->id;
    }
}
