<?php

namespace App\Services\Subscription;

use App\Models\Subscription;
use App\Models\User;
use App\Models\Website;
use App\Repositories\Subscription\SubscriptionRepository;
use Illuminate\Database\Eloquent\Collection;

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

    /**
     * @param Website|null $website
     * @return Collection|Subscription[]
     */
    public function getAllForWebsite(?Website $website): Collection
    {
        return $this->subscriptionRepository->getAllForWebsite($website->getId());
    }
}