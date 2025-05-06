<?php

namespace App\Models;

use App\Traits\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory, UseUuid;

    protected $fillable = [
        'user_id',
        'role_id',
        'department_id'
    ];

    protected $hidden = [
        'id',
        'user_id', 
        'role_id', 
        'department_id',
        'created_at',
        'updated_at'
    ];


    // Relationships
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

}
