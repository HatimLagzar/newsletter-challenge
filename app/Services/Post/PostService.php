<?php

namespace App\Services\Post;

use App\Events\PostCreatedEvent;
use App\Models\Post;
use App\Repositories\Post\PostRepository;

class PostService
{
    private PostRepository $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function create(array $attributes): Post
    {
        $post = $this->postRepository->create($attributes);

        dispatch(new PostCreatedEvent($post));

        return $post;
    }
}