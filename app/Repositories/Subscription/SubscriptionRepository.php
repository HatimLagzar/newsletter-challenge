<?php

namespace App\Repositories\Subscription;

use App\Models\Subscription;
use Illuminate\Database\Eloquent\Collection;

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

    /**
     * @param int $getId
     * @return Collection|Subscription[]
     */
    public function getAllForWebsite(int $id): Collection
    {
        return Subscription::query()
            ->where(Subscription::WEBSITE_ID_COLUMN, $id)
            ->get();
    }

    /**
     * @return Collection|Subscription[]
     */
    public function getAll(): Collection
    {
        return Subscription::query()
            ->get();
    }
}