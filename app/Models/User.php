<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, UseUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'apc_id',
        'first_name',
        'last_name',
        'email',
        'course_id',
        'acc_status_id',
        'department_id'
    ];



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'email_verified_at',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
        ];
    }

    // Relationships
    public function userRole()
    {
        return $this->hasOne(UserRole::class);
    }


    // Methods
    public function getUserRoleId()
    {
        return $this->belongsTo(Role::class, 'user_role_id');
    }
    public function getUserRole()
    {
        return $this->belongsTo(Role::class, 'user_role');
    }
    public function getAccountStatus()
    {
        $statusId = $this->acc_status_id;
        $accountStatus = AccountStatus::where('id', $statusId)->first();

        return $accountStatus ? $accountStatus->acc_status : null;
    }

    public function getUserIdBasedOnApcId($apcId)
    {
        $user = self::where('apc_id', $apcId)->first();

        return $user ? $user->id : null;
    }

    public function getNameBasedOnId($userId)
    {
        $user = self::where('id', $userId)->first();

        if ($user) {
            $firstName = $user->first_name;
            $lastName = $user->last_name;
            return $firstName . ' ' . $lastName;
        }

        return null;
    }

    public static function getApcIdBasedOnId($userId)
    {
        $user = self::where('id', $userId)->first();

        if ($user) {
            return $user->apc_id;
        }

        return null;
    }
}
