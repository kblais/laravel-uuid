<?php

namespace Kblais\Uuid;

use Ramsey\Uuid\Uuid as RamseyUuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

trait Uuid
{
    protected $uuid_version = 4;
    protected $uuid_string  = '';

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
        try {
            switch ($this->uuid_version) {
               case 1:
                    return RamseyUuid::uuid1()->toString();
                    break;

               case 3:
                    return RamseyUuid::uuid3(RamseyUuid::NAMESPACE_DNS, $this->uuid_string)->toString();
                    break;

               case 4:
                    return RamseyUuid::uuid4()->toString();
                    break;

               case 5:
                    return RamseyUuid::uuid5(RamseyUuid::NAMESPACE_DNS, $this->uuid_string)->toString();
                    break;

               default:
                    break;
           }
        } catch (UnsatisfiedDependencyException $e) {
            // Some dependency was not met. Either the method cannot be called on a
            // 32-bit system, or it can, but it relies on Moontoast\Math to be present.
            return 'Caught exception: '.$e->getMessage()."\n";
        }
    }
}
