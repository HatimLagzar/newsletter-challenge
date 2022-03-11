<?php

namespace App\Services\Subscription;

use App\Models\Subscription;
use App\Models\User;
use App\Models\Website;
use App\Repositories\Subscription\SubscriptionRepository;

class SubscriptionService
{
    private SubscriptionRepository $subscriptionRepository;

    public function __construct(SubscriptionRepository $subscriptionRepository)
    {
        $this->subscriptionRepository = $subscriptionRepository;
    }

    public function findByUserAndWebsite(User $user, Website $website): ?Subscription
    {
        return $this->subscriptionRepository->findByUserAndWebsite($user->getId(), $website->getId());
    }

    public function create(User $user, Website $website): Subscription
    {
        return $this->subscriptionRepository->create([
            Subscription::USER_ID_COLUMN => $user->getId(),
            Subscription::WEBSITE_ID_COLUMN => $website->getId(),
        ]);
    }
}