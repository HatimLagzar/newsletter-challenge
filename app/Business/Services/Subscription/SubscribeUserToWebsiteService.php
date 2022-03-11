<?php

namespace App\Business\Services\Subscription;

use App\Models\Subscription;
use App\Models\User;
use App\Models\Website;
use App\Services\Subscription\SubscriptionService;

class SubscribeUserToWebsiteService
{
    private SubscriptionService $subscriptionService;

    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    public function subscribe(User $user, Website $website): bool
    {
        $subscription = $this->subscriptionService->findByUserAndWebsite($user, $website);
        if ($subscription instanceof Subscription) {
            return true;
        }

        $this->subscriptionService->create($user, $website);

        return true;
    }
}