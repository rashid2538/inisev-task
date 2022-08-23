<?php

namespace App\Console\Commands;

use App\Mail\PostNewsletter;
use App\Models\Website;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendNewsletter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'newsletter:send {website}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends the latest post as newsletter from specified website id to its subscribers.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $websiteId = $this->argument('website');
        $website = Website::findOrFail($websiteId);
        $latestPost = $website->posts()->orderBy('created_at', 'desc')->first();
        if ($latestPost) {
            $emails = [];
            foreach ($website->subscribers as $user) {
                $emails[] = $user->email;
            }
            Mail::to($emails)->queue(new PostNewsletter($latestPost->id));
        }
    }
}
