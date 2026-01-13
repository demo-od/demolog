<?php

namespace App\Http\Controllers;

use App\Models\Post;

use App\Models\Category;
use Illuminate\Support\Str;
use function Ramsey\Uuid\v1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required'],
            'image' => ['required', 'image', 'max:2048'],
            'category' => ['required', 'exists:categories,id'],
            'published_at' => ['nullable', 'date'],
        ]);

        // 1. Upload to Cloudinary via the 'cloudinary' disk
        // This stores the file in a 'posts' folder and returns the public_id
        $path = Storage::disk('cloudinary')->put('posts', $request->file('image'));

        // 2. Get the secure URL from Cloudinary
        $imageUrl = Storage::disk('cloudinary')->url($path);

        $data['image'] = $imageUrl;             // Store the full URL
        $data['image_public_id'] = $path;       // Store the ID for future deletes

        $data['user_id'] = Auth::id();
        $data['category_id'] = $data['category'];
        $data['slug'] = Str::slug($data['title']);

        unset($data['category']);

        Post::create($data);

        return redirect()->route('dashboard');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $username,Post $post)
    {
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
