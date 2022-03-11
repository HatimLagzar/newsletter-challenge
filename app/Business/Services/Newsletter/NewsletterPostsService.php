<?php

namespace App\Business\Services\Newsletter;

use App\Models\NewsletterHistory;
use App\Models\Post;
use App\Models\User;
use App\Models\Website;
use App\Services\NewsletterHistory\NewsletterHistoryService;
use Illuminate\Database\Eloquent\Collection;

class NewsletterPostsService
{
    private NewsletterHistoryService $newsletterHistoryService;

    public function __construct(NewsletterHistoryService $newsletterHistoryService)
    {
        $this->newsletterHistoryService = $newsletterHistoryService;
    }

    /**
     * @param User $user
     * @param Website $website
     * @return Collection|Post[]
     */
    public function get(User $user, Website $website): Collection
    {
        $alreadySentPostsIds = $this->newsletterHistoryService->getAllByUser($user)
            ->pluck(NewsletterHistory::POST_ID_COLUMN)
            ->toArray();

        return $website->posts()->filter(function (Post $post) use ($alreadySentPostsIds) {
            return in_array($post->getId(), $alreadySentPostsIds) === false;
        });
    }

    /**
     * @param Collection|Post[] $posts
     * @param User $user
     * @return void
     */
    public function markAsSent(Collection $posts, User $user)
    {
        $posts->each(function (Post $post) use ($user) {
            $this->newsletterHistoryService->create([
                NewsletterHistory::POST_ID_COLUMN => $post->getId(),
                NewsletterHistory::USER_ID_COLUMN => $user->getId(),
            ]);
        });
    }
}