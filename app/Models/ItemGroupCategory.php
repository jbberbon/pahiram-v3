<?php

namespace App\Models;

use App\Traits\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemGroupCategory extends Model
{
    use HasFactory, UseUuid;

    protected $fillable = [
        'name',
        'is_consumable'
    ];
    protected $hidden = [
        'id',
        'created_at',
        'updated_at'
    ];

    public static function getIdByName($category)
    {
        $category = self::where('category_name', $category)->first();
        return $category?->id;
    }

    public static function getCategoryNameById($categoryId)
    {
        $category = self::where('id', $categoryId)->first();
        return $category ? $category->category_name : null;
    }
}
