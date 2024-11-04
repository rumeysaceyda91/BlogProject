<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use Inertia\Inertia;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Passport;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    public function index()
    {
        if(Cache::has('cached_posts')){
            //dd(Cache::get('cached_posts'));
            return Inertia::render('Index', [
                'posts' => Cache::get('cached_posts')
            ]);
        }else{
            $query =  Post::query();
        
            $sortField = request("sort_field", 'created_at');
            $sortDirection = request("sort_direction", "asc");

            $posts = $query->orderBy($sortField, $sortDirection)
                ->paginate(20)
                ->onEachSide(1);

            Cache::put('cached_posts', $posts, 120);    
                
            return Inertia::render('Index', [
                'posts' => $posts
            ]);
        }
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
        $post_count = Post::whereDate('created_at', \Carbon\Carbon::today())
                          ->where('user_id','=',$data['user_id'])->count();

        if($post_count >= 30){
            return back()->withErrors(['name' => 'You have exceeded the number of three post creations.']);
        }else{
            $post = Post::create($data);
            $slug = Str::slug("{$post->title}-{$post->id}");
            $post->update(['slug' => $slug]);

            $query =  Post::query();
       
            $sortField = request("sort_field", 'created_at');
            $sortDirection = request("sort_direction", "asc");

            $last_posts = $query->orderBy($sortField, $sortDirection)
                ->paginate(20)
                ->onEachSide(1);

            Cache::put('cached_posts', $last_posts, 120); 

            return back()->withSuccess('Post was created successfully!!');
        }
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
