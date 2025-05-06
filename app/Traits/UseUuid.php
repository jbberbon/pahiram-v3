<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait UseUuid
{
    protected static function bootUseUuid()
    {
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    public function initializeUseUuid()
    {
        $this->incrementing = false;
        $this->keyType = 'string';
    }
}
