<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\SubscribeRequest;
use App\Models\Post;
use App\Models\Website;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api')]
class ApiController extends Controller
{

    // Endpoint to create a "post" for a "particular website".
    #[Route('/create-post', methods:'POST')]
    public function createPost(CreatePostRequest $request)
    {
        try {
            $post = Post::create($request->validated());
            return $this->success(['post_id' => $post->id]);
        } catch (\Exception$ex) {
            Log::error($ex->getMessage(), $ex);
            return $this->failure("Error occured while creating a new post, contact administrator for more information!");
        }
    }

    // Endpoint to make a user subscribe to a "particular website" with all the tiny validations included in it.
    #[Route('/subscribe', methods:'POST')]
    public function subscribe(SubscribeRequest $request)
    {
        $requestData = $request->validated();
        try {
            $website = Website::find($requestData['website_id']);
            if ($website->subscribers()->wherePivot('user_id', $requestData['user_id'])->count() == 1) {
                return $this->failure("User is already subscribed to {$website->name}!");
            }
            $website->subscribers()->attach($requestData['user_id']);
            return $this->success("User subscribed to {$website->name}.");
        } catch (\Exception$ex) {
            Log::error($ex->getMessage(), $ex);
            return $this->failure("Error occured while subscribing to the website, contact administrator for more information!");
        }
    }

    #[Route('/unsubscribe', methods:'POST')]
    public function unsubscribe(SubscribeRequest $request)
    {
        $requestData = $request->validated();
        try {
            $website = Website::find($requestData['website_id']);
            if ($website->subscribers()->wherePivot('user_id', $requestData['user_id'])->count() == 1) {
                $website->subscribers()->detach($requestData['user_id']);
                return $this->success("User unsubscribed from {$website->name}.");
            } else {
                return $this->failure("User is not subscribed to {$website->name}!");
            }
        } catch (\Exception$ex) {
            Log::error($ex->getMessage(), $ex);
            return $this->failure("Error occured while subscribing to the website, contact administrator for more information!");
        }
    }

    private function success(mixed $result = true)
    {
        return response()->json([
            'status' => 200,
            'error' => false,
            'result' => $result,
        ]);
    }

    private function failure(mixed $message = true)
    {
        return response()->json([
            'status' => 500,
            'error' => true,
            'message' => $message,
        ]);
    }
}
