<?php

namespace App\Models;

use App\Traits\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Str;

class Role extends Model
{
    use HasFactory, UseUuid;

    protected $fillable = [
        'name',
        'description'
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at'
    ];

    public static function getIdByRole($role)
    {
        $retrievedRole = self::where('role', $role)->first();

        return $retrievedRole?->id;
    }
    public static function getRoleById($id)
    {
        $retrievedRole = self::where('id', $id)->first();

        return $retrievedRole?->role;
    }
}