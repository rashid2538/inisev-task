<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testsCreateNewWebsitePost()
    {
        $this->json('POST', 'api/create-post', [
            'title' => 'A test title',
            'description' => 'Test case post description',
            'website_id' => 1,
        ])->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testsWebsiteSubscription()
    {
        $this->json('POST', 'api/subscribe', [
            'website_id' => mt_rand(1, 3),
            'user_id' => mt_rand(1, 10),
        ])->assertStatus(200);
    }
}
