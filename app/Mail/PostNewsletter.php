<?php

namespace App\Mail;

use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PostNewsletter extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public Post $post;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(int $postId)
    {
        $this->post = Post::findOrFail($postId);
        echo "Sending newsletter ...";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.newsletter');
    }
}