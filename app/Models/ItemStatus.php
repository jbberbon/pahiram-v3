<?php

namespace App\Models;

use App\Traits\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemStatus extends Model
{
    use HasFactory, UseUuid;

    protected $fillable = [
        'item_status',
        'description'
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at'
    ];

    public static function getIdByStatus($status)
    {
        $status = self::where('item_status', $status)->first();

        return $status ? $status->id : null;
    }

    public static function getStatusById($statusId)
    {
        $status = self::where('id', $statusId)->first();

        return $status ? $status->item_status : null;
    }
}
