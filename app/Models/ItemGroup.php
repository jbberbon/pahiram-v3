<?php

namespace App\Models;

use App\Traits\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemGroup extends Model
{
    use HasFactory, UseUuid;
    protected $fillable = [
        'model_name',
        'description',

        //FK
        'group_category_id',
    ];

    protected $hidden = [
        // 'id', // Needs to be shown in the API
        'created_at',
        'updated_at'
    ];

    // Relationships
    public function items()
    {
        return $this->hasMany(Item::class, 'item_group_id');
    }
    public function itemGroupImages()
    {
        return $this->hasMany(ItemGroupImage::class);
    }



    public function getGroupItems()
    {
        return $this->belongsTo(Item::class, 'item_group_id');
    }
    public function getActiveItemCount()
    {
        $activeStatus = ItemStatus::where('item_status_code', 2010)->first();
        if (!$activeStatus) {
            // Throw an exception if the active status is not found
            throw new \RuntimeException(response([
                'status' => false,
                'type' => "Exception",
                'message' => "Active status is not found in ItemGroup model getActiveItemCount()",
            ], 404));
        }
        return $this->items()->where('item_status_id', $activeStatus->id)->count();
    }

    public static function getOfficeById($itemGroupId)
    {
        $itemGroup = self::find($itemGroupId);

        if (!$itemGroup) {
            return null;
        }

        return Department::getAcronymById($itemGroup->department_id);

    }

    public static function getIdByModelNameAndOfficeId(string $modelName, string $officeId): string|null
    {
        $itemGroup = self::where('model_name', $modelName)
            ->where('department_id', $officeId)
            ->first();

        return $itemGroup ? $itemGroup->id : null;
    }
}
