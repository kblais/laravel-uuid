<?php

namespace Kblais\Uuid;

use Ramsey\Uuid\Uuid as RamseyUuid;

trait Uuid
{
    public function getIncrementing()
    {
        return false;
    }

    public static function bootUuid()
    {
        static::creating(function ($model) {
            $uuid = $model->generateUuid();

            if (empty($model->attributes[$model->getKeyName()])) {
                $model->attributes[$model->getKeyName()] = $uuid;
            }
        });
    }

    protected function generateUuid()
    {
        return RamseyUuid::uuid4()->toString();
    }
}
