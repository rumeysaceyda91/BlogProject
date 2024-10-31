<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Passport;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        //dd(Auth::user());
        return Inertia::render('Index', [
            'posts' => Post::all()
        ]);
    }
    public function create()
    {
        return inertia("Post/Create");
    }
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|string',
            'content'=>'required|string'
        ]);
        $data['title'] = $request->title;
        $data['content'] = $request->content;
        $data['user_id'] = Auth::id();
        
        $post = Post::create($data);
        $slug = Str::slug("{$post->title}-{$post->id}");
        $post->update(['slug' => $slug]);

        return to_route('post.index')
            ->with('success', 'Post was created');
    }

    public function show($slug)
    {
        $post = Post::select('*')->where('slug', '=', $slug)
        ->get();

        return inertia('Post/Show', [
            'post' => $post
        ]);
    }
}
