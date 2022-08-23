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
        $this->json('POST', 'api/1/create-post', [
            'title' => 'A test title',
            'description' => 'Test case post description'
        ])
        ->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testsWebsiteSubscription()
    {
        $this->json('POST', 'api/1/subscribe/1')
            ->assertStatus(200);
    }
}
