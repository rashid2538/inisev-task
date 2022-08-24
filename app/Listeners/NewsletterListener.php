<?php

namespace App\Listeners;

use App\Mail\PostNewsletter;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class NewsletterListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $recentPosts = Post::recent()->get();
        $recentPostIds = $recentPosts->map(fn($post) => $post->id)->toArray();
        User::has('subscribedWebsites')->with('subscribedWebsites')->chunk(10, function ($users) use ($recentPostIds, $recentPosts) {
            foreach ($users as $user) {
                $subscribedWebsiteIds = $user->subscribedWebsites->map(fn($website) => $website->id)->toArray();

                $notifiedPosts = $user->notifiedPosts()->where('id', '>=', min($recentPostIds))->select('id')->get()->map(fn($post) => $post->id)->toArray();

                $newsletterPosts = $recentPosts->filter(fn($post) => !in_array($post->id, $notifiedPosts) && in_array($post->website_id, $subscribedWebsiteIds));

                if ($newsletterPosts->count() > 0) {
                    Mail::to($user->email)->send(new PostNewsletter($newsletterPosts->map(fn($post) => ['title' => $post->title, 'description' => $post->description])->toArray()));

                    $newsletterPostIds = $newsletterPosts->map(fn($post) => $post->id)->toArray();

                    $user->notifiedPosts()->attach($newsletterPostIds);
                }
            }
        });
    }
}
