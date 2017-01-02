<?php

namespace Kblais\Uuid;

use Ramsey\Uuid\Uuid as RamseyUuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

trait Uuid
{
    /**
     * disable priKey auto increment.
     *
     * @return bool
     */
    public function getIncrementing()
    {
        return false;
    }

    /**
     * auto generate Uuid for each saved model.
     *
     * @return [type] [description]
     */
    public static function bootUuid()
    {
        static::creating(function ($model) {
            $uuid = $model->generateUuid();

            if (empty($model->attributes[$model->getKeyName()])) {
                $model->attributes[$model->getKeyName()] = $uuid;
            }
        });
    }

    /**
     * generateUuid.
     *
     * @return [type] [description]
     */
    protected function generateUuid()
    {
        try {
            switch ($this->getUuidVersion()) {
                case 1:
                    return RamseyUuid::uuid1()->toString();
                    break;

                case 3:
                    return RamseyUuid::uuid3(RamseyUuid::NAMESPACE_DNS, $this->getUuidString())->toString();
                    break;

                case 4:
                    return RamseyUuid::uuid4()->toString();
                    break;

                case 5:
                    return RamseyUuid::uuid5(RamseyUuid::NAMESPACE_DNS, $this->getUuidString())->toString();
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

    /**
     * getUuidVersion or default to 4.
     *
     * @return int
     */
    protected function getUuidVersion()
    {
        return $this->uuid_version ?: 4;
    }

    /**
     * getUuidString for uuid 3/5.
     *
     * @return string
     */
    protected function getUuidString()
    {
        return $this->uuid_string ?: '';
    }
}
