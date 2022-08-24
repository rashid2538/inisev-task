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

    public $posts;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($posts)
    {
        $this->posts = $posts;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        echo "Sending newsletter ...";
        return $this->markdown('emails.newsletter');
    }
}