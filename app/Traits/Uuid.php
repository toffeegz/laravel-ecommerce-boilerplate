<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Uuid {
    protected static function bootUuid() {
        static::creating(function ($model) {
            if(!$model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function getIncrementing() : bool {
        return false;
    }

    public function getKeyType() : string {
        return 'string';
    }
}