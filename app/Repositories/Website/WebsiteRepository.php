<?php

namespace App\Repositories\Website;

use App\Models\Website;

class WebsiteRepository
{
    public function findById(int $id): ?Website
    {
        return Website::query()
            ->where(Website::ID_COLUMN, $id)
            ->first();
    }
}