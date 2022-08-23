<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Website;
use Illuminate\Http\Request;

class ApiController extends Controller {

    // Endpoint to create a "post" for a "particular website".
    public function createPost(Website $website, Request $createPostRequest) {
        $requestData = $createPostRequest->validate([
            'title' => 'required|max:255',
            'description' => 'required',
        ]);
        $requestData['website_id'] = $website->id;
        $post = Post::create($requestData);
        return $this->success(['post_id' => $post->id]);
    }

    // Endpoint to make a user subscribe to a "particular website" with all the tiny validations included in it.
    public function subscribe(Website $website, User $user) {
        try {
            $website->subscribers()->attach($user);
            return $this->success("{$user->name} has subscribed to {$website->name}.");
        } catch(\Exception $ex) {
            return $this->failure("{$user->name} is already subscribed to {$website->name}!");
        }
    }

    // Endpoint to make a user subscribe to a "particular website" with all the tiny validations included in it.
    public function unsubscribe(Website $website, User $user) {
        $website->subscribers()->detach($user);
        return $this->success("{$user->name} has unsubscribed to {$website->name}.");
    }

    private function success(mixed $result = true) {
        return response()->json([
            'status' => 200,
            'error' => false,
            'result' => $result,
        ]);
    }

    private function failure(mixed $message = true) {
        return response()->json([
            'status' => 500,
            'error' => true,
            'message' => $message,
        ]);
    }
}