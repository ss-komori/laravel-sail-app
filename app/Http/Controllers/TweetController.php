<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\TweetRequest;
use App\Http\Controllers\Controller;

class TweetController extends Controller
{
    /**
     * @return Collection
     */
    public function index()
    {
        return DB::table('tweets')
            ->selectRaw('id')
            ->selectRaw('title')
            ->selectRaw('content')
            ->selectRaw('user_id')
            ->selectRaw('created_at')
            ->selectRaw('updated_at')
            ->get();
    }

    /**
     * @param TweetRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function store(TweetRequest $request)
    {
        $tweet = Tweet::create($request->all());
        return $tweet
            ? response()->json($tweet, 201)
            : response()->json([], 500);
    }

    /**
     * @param TweetRequest $request
     * @param Tweet $tweet
     * @return JsonResponse
     */
    public function update(TweetRequest $request, Tweet $tweet)
    {
        $tweet->title = $request->title ?? $tweet->title;
        $tweet->content = $request->content ?? $tweet->content;

        return $tweet->update()
            ? response()->json($tweet)
            : response()->json([], 500);
    }

    /**
     * @param Tweet $tweet
     * @return JsonResponse
     */
    public function destroy(Tweet $tweet)
    {
        return $tweet->delete()
            ? response()->json($tweet)
            : response()->json([], 500);
    }
}
