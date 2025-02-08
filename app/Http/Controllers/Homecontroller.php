<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Homecontroller extends Controller
{
    public function index(Request $request){
        $posts = Post::with('user:id,username')->latest()->paginate(5);
        if ($request->wantsJson()) {
            return response()->json([
                'posts' => $posts->items(),
                'current_page' => $posts->currentPage(),
                'last_page' => $posts->lastPage(),
            ]);
        }
        return inertia('App', ['isLoggedIn' => true, 'loggedUser' => Auth::user(), 'posts' => $posts]);
    }
}
