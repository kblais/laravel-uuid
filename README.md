# laravel-uuid [![Build Status](https://travis-ci.org/kblais/laravel-uuid.svg?branch=master)](https://travis-ci.org/kblais/laravel-uuid)

A simple library to use UUIDs as your Eloquent model's primary key.

## Why should I use UUIDs ?

To answer this question, I simply recommend you read [this blog post](https://www.clever-cloud.com/blog/engineering/2015/05/20/why-auto-increment-is-a-terrible-idea/).

## OK, I'm convinced now. How do I install this ?

Require this package with Composer :

```
composer require kblais/laravel-uuid
```

* the package internally use [ramsey/uuid](https://packagist.org/packages/ramsey/uuid) to generate the UUIDs.

## Usage

First, your model's column must be a 36 characters column :

* Laravel v4

```php
$table->char('id', 36);
$table->primary('id');
```

* Laravel v5+

```php
$table->uuid('id');
$table->primary('id');
```

Then, just add the `Kblais\Uuid\Uuid` trait to your model, and you're done :

```php
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kblais\Uuid\Uuid;

class User extends Model
{
    use Uuid;
}
```

Version 4 UUIDs are used by default. You can change this by overriding the `$uuidVersion & $uuidString` variables. For example :

```php
protected $uuidVersion = 1;
protected $uuidString  = ''; // only needed when $uuidVersion is "3 or 5"
```

The supported UUIDs versions here are "1, 3, 4 and 5".
