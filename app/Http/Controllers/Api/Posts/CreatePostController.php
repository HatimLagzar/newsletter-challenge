<?php

namespace App\Http\Controllers\Api\Posts;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\CreatePostRequest;
use App\Models\Post;
use App\Models\Website;
use App\Services\Post\PostService;
use App\Services\Website\WebsiteService;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class CreatePostController extends BaseController
{
    private WebsiteService $websiteService;
    private PostService $postService;

    public function __construct(WebsiteService $websiteService, PostService $postService)
    {
        $this->websiteService = $websiteService;
        $this->postService = $postService;
    }

    public function __invoke(CreatePostRequest $request)
    {
        try {
            $websiteId = $request->get('website_id');
            $website = $this->websiteService->findById($websiteId);
            if (!$website instanceof Website) {
                return $this->withError('Website not found', Response::HTTP_NOT_FOUND);
            }

            $this->postService->create($request->only([Post::TITLE_COLUMN, Post::DESCRIPTION_COLUMN, Post::WEBSITE_ID_COLUMN]));

            return $this->withSuccess(['message' => 'Post created successfully.']);
        } catch (Throwable $e) {
            throw $e;
            Log::error($e->getMessage());

            return $this->withError('Internal error occurred, please retry later.');
        }
    }
}