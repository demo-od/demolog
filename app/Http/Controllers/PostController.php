<?php

namespace App\Http\Controllers;

use App\Models\Post;

use App\Models\Category;
use App\Models\Comment;
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
        $user = auth()->user();
        $query = Post::with('user');

        if ($user) {
            $followingIds = $user->following()->pluck('users.id')->toArray();

            if (!empty($followingIds)) {
                // Convert IDs to a comma-separated string for the SQL IN clause
                $idList = implode(',', $followingIds);

                // If user_id is in the list, give it priority (0), otherwise (1)
                // Then sort by that priority ASC (0 comes before 1)
                $query->orderByRaw("CASE WHEN user_id IN ($idList) THEN 0 ELSE 1 END");
            }
        }

        // Secondary sort: Newest posts first within those groups
        $posts = $query->latest()->paginate(10);

        return view('post.index', compact('posts'));
    } /**
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

        return redirect()->route('dashboard')->with('success', 'Your post was uploaded successfully!');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $username, Post $post)
    {
        $post->load([
            'comments' => function ($query) {
                $query->latest();
            }
        ]);
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('post.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // 1. Authorize
        if (auth()->id() !== $post->user_id) {
            abort(403);
        }

        // 2. Validate (Image is now 'nullable' since it's an update)
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required'],
            'image' => ['nullable', 'image', 'max:2048'],
            'category' => ['required', 'exists:categories,id'],
            'published_at' => ['nullable', 'date'],
        ]);

        // 3. Handle Image Update
        if ($request->hasFile('image')) {
            // Delete the old image from Cloudinary
            if ($post->image_public_id) {
                try {
                    Storage::disk('cloudinary')->delete($post->image_public_id);
                } catch (\Throwable $e) {
                    // Fail silently or log
                }
            }

            // Upload new image
            $path = Storage::disk('cloudinary')->put('posts', $request->file('image'));
            $imageUrl = Storage::disk('cloudinary')->url($path);

            $post->image = $imageUrl;
            $post->image_public_id = $path;
        }

        // 4. Update the rest of the fields
        $post->title = $data['title'];
        $post->content = $data['content'];
        $post->category_id = $data['category'];
        $post->slug = Str::slug($data['title']);

        $post->save();

        return redirect()->back()->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if (auth()->id() !== $post->user_id) {
            abort(403);
        }

        // Delete image from Cloudinary before deleting record
        if ($post->image_public_id) {
            Storage::disk('cloudinary')->delete($post->image_public_id);
        }

        $post->delete();

        return redirect()->route('dashboard')->with('success', 'Your post has been deleted.');
    }

    public function category(Category $category)
    {
        $user = auth()->user();
        $query = $category->posts()->with('user'); // Start with the category's posts

        if ($user) {
            $followingIds = $user->following()->pluck('users.id')->toArray();

            if (!empty($followingIds)) {
                $idList = implode(',', array_map('intval', $followingIds));

                // Use CASE for SQLite compatibility
                $query->orderByRaw("CASE WHEN user_id IN ($idList) THEN 0 ELSE 1 END");
            }
        }

        // Apply chronological sort and paginate
        $posts = $query->latest()->paginate(10);

        return view('post.index', compact('posts', 'category'));
    }
    public function Comment(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string|max:50',
        ]);

        Comment::create([
            'content' => $request->content,
            'user_id' => auth()->id(),
            'post_id' => $post->id,
        ]);

        return back()->with('success', 'Your comment has been uploaded!');

    }

    public function deleteComment(Comment $comment)
    {
        // Check if the user is authorized to delete it
        if (auth()->id() !== $comment->user_id) {
            abort(403);
        }

        $comment->delete();

        return back()->with('success', 'Comment deleted successfully!');
    }
}
