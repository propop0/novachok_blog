<?php

namespace App\Http\Controllers\Api\Blog;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = BlogPost::with('category')->get();
        return response()->json($posts);
    }

    public function show($id)
    {
        $post = BlogPost::with('category')->findOrFail($id);
        return response()->json($post);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|min:3',
            'slug' => 'nullable|string',
            'content' => 'required|string',
            'category_id' => 'nullable|integer|exists:blog_categories,id',
        ]);
        $data['user_id'] = auth()->id() ?? 1;
        $data['content_raw'] = $data['content'];
        $post = BlogPost::create($data);
        return response()->json($post, 201);
    }

    public function update(Request $request, $id)
    {
        $post = BlogPost::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string|min:3',
            'slug' => 'nullable|string',
            'content' => 'required|string',
            'category_id' => 'nullable|integer|exists:blog_categories,id',
        ]);

        $post->update($data);

        return response()->json($post);
    }

    public function destroy($id)
    {
        $post = BlogPost::findOrFail($id);
        $post->delete();

        return response()->json(['message' => 'Статтю видалено']);
    }
}
