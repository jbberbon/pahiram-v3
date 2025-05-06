<?php

namespace App\Models;

use App\Traits\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory, UseUuid;

    protected $fillable = [
        'apc_item_id',
        'is_borrowable',
        'is_required_supervisor_approval',

        // TODO: Ommitted for now
        // 'manufacturer_serial_num',
        // 'warranty_expiration',
        // 'unit_cost',
        // 'supplier_name',
        // 'supplier_tel_num',
        // 'supplier_email',

        // FK
        'department_id',
        'possessed_by',
        'item_group_id',
        'item_status_id',

        // TODO: Uncomment when purchase orders are implemented
        // 'purchase_order_id',
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at'
    ];

    // Relationships
    public function itemGroup()
    {
        return $this->belongsTo(ItemGroup::class);
    }

    public function itemStatus()
    {
        return $this->belongsTo(ItemStatus::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
