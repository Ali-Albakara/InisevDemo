<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscription:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends a daily email to all users with a subscription';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Post::where('created_at', '>=', now()->subDays(1))->get()->each(function ($post) {
            $post->website->subscriptions->each(function ($subscription) use ($post) {
                $subscription->user->notify(new \App\Notifications\NewPostNotification($post));
            });
        });
    }
}
