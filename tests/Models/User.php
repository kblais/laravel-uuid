<?php

namespace Kblais\Uuid\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Kblais\Uuid\Uuid;
use Ramsey\Uuid\Uuid as RamseyUuid;

class User extends Model
{
    use Uuid;

    protected $fillable = ['name', 'email'];

    protected $uuidVersion = 1;
}
