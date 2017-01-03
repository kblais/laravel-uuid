<?php

namespace Kblais\Uuid\Tests;

use Illuminate\Http\Request;
use Kblais\Uuid\Tests\Models\Post;
use Kblais\Uuid\Tests\Models\User;
use Ramsey\Uuid\Uuid;

class UuidTest extends TestCase
{
    public function testUuid4Applies()
    {
        $post = Post::create([
            'title' => 'My new post',
        ]);

        $this->assertTrue(
            Uuid::isValid($post->id),
            'The id is not a valid UUID'
        );
    }

    public function testUuid1Applies()
    {
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'john.doe@test.com',
        ]);

        $this->assertTrue(
            Uuid::isValid($user->id),
            'The id is not a valid UUID'
        );
    }
}
