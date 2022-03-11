<?php

namespace App\Repositories\Subscription;

use App\Models\Subscription;

class SubscriptionRepository
{
    public function findByUserAndWebsite(int $userId, int $websiteId): ?Subscription
    {
        return Subscription::query()
            ->where(Subscription::USER_ID_COLUMN, $userId)
            ->where(Subscription::WEBSITE_ID_COLUMN, $websiteId)
            ->first();
    }

    public function create(array $attributes): Subscription
    {
        return Subscription::query()
            ->create($attributes);
    }
}