<?php

namespace Kblais\Uuid\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Kblais\Uuid\Uuid;

class Post extends Model
{
    use Uuid;

    protected $fillable = ['title'];
}
