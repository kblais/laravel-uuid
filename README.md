# laravel-uuid [![Build Status](https://travis-ci.org/kblais/laravel-uuid.svg?branch=add-travis)](https://travis-ci.org/kblais/laravel-uuid)

A simple library to use UUIDs as your Eloquent model's primary key.

## Why should I use UUIDs ?

To answer this question, I simply recommend you read [this blog post](https://www.clever-cloud.com/blog/engineering/2015/05/20/why-auto-increment-is-a-terrible-idea/).

## OK, I'm convinced now. How do I install this ?

Require this package with Composer :

```
composer require kblais/laravel-uuid
```

## Usage

First, your model's column must be a 36 characters column :

```php
$table->char('id', 36);
```

Since Laravel 5.1, you can use the `uuid()` shortcut method :

```php
$table->uuid('id');
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

Version 4 UUIDs are used by default. You can change this by overriding the `generateUuid()` function. For example :

```php
protected function generateUuid()
{
    return Ramsey\Uuid\Uuid::uuid1()->toString();
}
```

The library used to generate UUIDs here only supports versions 1, 3, 4 and 5.
