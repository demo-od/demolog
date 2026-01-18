<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function like(Post $post) {
        $hasClapped = auth()->user()->hasLiked($post);
        if($hasClapped) {
            $post->likes()->where('user_id', auth()->id())->delete();

            return response()->json(['likesCount' => $post->likes()->count()]);
        } else {
        $post->likes()->create([
            'user_id' => auth()->id(),
        ]);

        return response()->json(['likesCount' => $post->likes()->count()]);
    }}
}
