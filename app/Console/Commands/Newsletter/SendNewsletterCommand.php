<?php

namespace App\Console\Commands\Newsletter;

use App\Business\Services\Newsletter\NewsletterPostsService;
use App\Mail\NewsletterMail;
use App\Models\Subscription;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class SendNewsletterCommand extends Command
{
    public const CHUNK_SIZE = 100;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'newsletter:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send the new posts to the subscribers';

    private NewsletterPostsService $newsletterPostsService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(NewsletterPostsService $newsletterPostsService)
    {
        parent::__construct();
        $this->newsletterPostsService = $newsletterPostsService;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        Subscription::query()
            ->chunkById(self::CHUNK_SIZE, function (Collection $subscriptions) {
                $subscriptions->each(function (Subscription $subscription) {
                    try {
                        $website = $subscription->website();
                        $user = $subscription->user();

                        $posts = $this->newsletterPostsService->get($user, $website);

                        if ($posts->count() === 0) {
                            $this->info('all posts already sent for user id='. $user->getId());

                            return;
                        }

                        Mail::to($subscription->user())
                            ->queue(new NewsletterMail($posts));

                        $this->newsletterPostsService->markAsSent($posts, $user);

                        $this->info('Newsletter sent to user id=' . $user->getId());
                    } catch (Throwable $e) {
                        Log::error($e->getMessage());
                        $this->error($e->getMessage());
                    }
                });
            });
    }
}
