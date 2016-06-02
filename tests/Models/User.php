<?php

namespace Kblais\Uuid\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Kblais\Uuid\Uuid;
use Ramsey\Uuid\Uuid as RamseyUuid;

class User extends Model
{
    use Uuid;

    protected $fillable = ['name', 'email'];

    protected function generateUuid()
    {
        return RamseyUuid::uuid1()->toString();
    }
}
