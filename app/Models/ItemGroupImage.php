<?php

namespace App\Models;

use App\Traits\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemGroupImage extends Model
{
    use HasFactory, UseUuid;

    protected $fillable = [
        'item_group_id',
        'url'
    ];
    
    protected $hidden = [
        'id',
        'created_at',
        'updated_at'
    ];
}
