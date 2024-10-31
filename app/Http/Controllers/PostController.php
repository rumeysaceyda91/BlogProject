<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use Inertia\Inertia;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Passport;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $query = Post::query();

        $sortField = request("sort_field", 'created_at');
        $sortDirection = request("sort_direction", "desc");

        $posts = $query->orderBy($sortField, $sortDirection)
            ->paginate(20)
            ->onEachSide(1);
            //dd($posts);
        return Inertia::render('Index', [
            'posts' => $posts
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
        ->first();
        
        return inertia::render('Post/Show', [
            'post' => $post
        ]);
    }
}
