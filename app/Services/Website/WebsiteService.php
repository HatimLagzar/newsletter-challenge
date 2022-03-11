<?php

namespace App\Services\Website;

use App\Models\Website;
use App\Repositories\Website\WebsiteRepository;

class WebsiteService
{
    private WebsiteRepository $websiteRepository;

    public function __construct(WebsiteRepository $websiteRepository)
    {
        $this->websiteRepository = $websiteRepository;
    }

    public function findById(int $id): ?Website
    {
        return $this->websiteRepository->findById($id);
    }
}