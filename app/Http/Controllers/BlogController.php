<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function categoryIndex(){
        return view('blog.category');
    }

    public function postsIndex(){
        $posts = Post::with('user','category')->get();
        return response()->json($posts);
    }

    public function postsStore(Request $request){
        $request->validate([
            'title' => 'required|max:200',
            'content' => 'required',
            'image' => 'required|image|mimes:png,jpg,gif|max:2048',
            'category' => 'required'
        ]);

        $imagePath = $request->file('image')->store('public/images');
        $userId = Auth::id();

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'image' => $imagePath,
            'user_id' => $userId
        ]);

        return response()->json(['msg' => 'Post Created Successfully..!']);
    }

}
