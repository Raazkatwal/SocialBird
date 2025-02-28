<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Homecontroller extends Controller
{
    public function index(Request $request){
        $posts = Post::with('user:id,username', 'likes')->latest()->paginate(5);
        $likes = Like::select('user_id', 'post_id')->get();
        $loggedUser = User::select('id', 'username', 'email')->with('posts', 'likedPosts')->find(Auth::id());
        if ($request->wantsJson()) {
            return response()->json([
                'posts' => $posts->items(),
                'current_page' => $posts->currentPage(),
                'last_page' => $posts->lastPage(),
            ]);
        }
        return inertia('App', ['isLoggedIn' => true, 'loggedUser' => $loggedUser, 'posts' => $posts, 'likes' => $likes]);
    }
}
