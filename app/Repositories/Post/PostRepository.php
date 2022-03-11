<?php

namespace App\Repositories\Post;

use App\Models\Post;

class PostRepository
{
    public function create(array $attributes): Post
    {
        return Post::query()
            ->create($attributes);
    }
}