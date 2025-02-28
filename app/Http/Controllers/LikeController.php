<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggleLike(Request $request, $postId){
        $user = User::with('likedPosts')->find(Auth::id());
        $post = Post::findorFail($postId);

        $likeExists = $post->likes()->where('user_id', $user->id)->exists();

        if($likeExists){
            $post->likes()->detach($user->id);
            $post->total_likes = $post->likes()->count();
            $post->save();
        } else {
            $post->likes()->attach($user->id);
            $post->total_likes = $post->likes()->count();
            $post->save();
        }
        // return dd($user->likedPosts()->get());
        return response()->json(['likes_count' => $post->likes()->count(), 'liked_posts' => $user->likedPosts()->get()]);
    }
}
