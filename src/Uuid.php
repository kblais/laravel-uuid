<?php

namespace Kblais\Uuid;

use Ramsey\Uuid\Uuid as RamseyUuid;

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
        switch ($this->getUuidVersion()) {
            case 1:
                return RamseyUuid::uuid1()->toString();
            case 3:
                return RamseyUuid::uuid3(RamseyUuid::NAMESPACE_DNS, $this->getUuidString())->toString();
            case 4:
                return RamseyUuid::uuid4()->toString();
            case 5:
                return RamseyUuid::uuid5(RamseyUuid::NAMESPACE_DNS, $this->getUuidString())->toString();
            default:
                break;
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
