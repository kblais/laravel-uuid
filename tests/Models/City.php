<?php

namespace Kblais\Uuid\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Kblais\Uuid\Uuid;

class City extends Model
{
    use Uuid;

    protected $fillable = ['name'];

    protected $uuid_version = 6;
}
