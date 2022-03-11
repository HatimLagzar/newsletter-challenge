<?php

namespace App\Http\Controllers\Api\Subscriptions;

use App\Business\Services\Subscription\SubscribeUserToWebsiteService;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\SubscribeUserRequest;
use App\Models\User;
use App\Models\Website;
use App\Services\User\UserService;
use App\Services\Website\WebsiteService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class SubscribeUserController extends BaseController
{
    private UserService $userService;
    private WebsiteService $websiteService;
    private SubscribeUserToWebsiteService $subscribeUserToWebsiteService;

    public function __construct(
        UserService $userService,
        WebsiteService $websiteService,
        SubscribeUserToWebsiteService $subscribeUserToWebsiteService
    ) {
        $this->userService = $userService;
        $this->websiteService = $websiteService;
        $this->subscribeUserToWebsiteService = $subscribeUserToWebsiteService;
    }

    public function __invoke(SubscribeUserRequest $request): JsonResponse
    {
        try {
            $userId = $request->get('user_id');
            $websiteId = $request->get('website_id');

            $user = $this->userService->findById($userId);
            if (!$user instanceof User) {
                return $this->withError('User not found', Response::HTTP_NOT_FOUND);
            }

            $website = $this->websiteService->findById($websiteId);
            if (!$website instanceof Website) {
                return $this->withError('Website not found', Response::HTTP_NOT_FOUND);
            }

            $this->subscribeUserToWebsiteService->subscribe($user, $website);

            return $this->withSuccess([
                'message' => 'Subscribed successfully!'
            ]);
        } catch (Throwable $e) {
            Log::error($e->getMessage());

            return $this->withError('Internal error occurred, please retry later.');
        }
    }
}