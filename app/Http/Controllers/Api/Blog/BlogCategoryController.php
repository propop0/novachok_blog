<?php

namespace App\Http\Controllers\Api\Blog;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    public function index()
    {
        return BlogCategory::with('parentCategory:id,title')->get();
    }
    public function show($id)
    {
        $category = BlogCategory::with('parentCategory:id,title')->findOrFail($id);
        return response()->json($category);
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|min:3',
            'slug' => 'nullable|string',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|integer|exists:blog_categories,id',
        ]);

        $category = BlogCategory::create($data);

        return response()->json($category, 201);
    }

    public function update(Request $request, $id)
    {
        $category = BlogCategory::find($id);
        if (!$category) {
            return response()->json(['message' => 'Категорію не знайдено'], 404);
        }

        $data = $request->validate([
            'title' => 'required|string|min:3',
            'slug' => 'nullable|string',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|integer|exists:blog_categories,id',
        ]);
        \Log::info('Update category data:', $data);

        $category->update($data);

        return response()->json($category);
    }
    public function destroy($id)
    {
        $category = BlogCategory::find($id);
        if (!$category) {
            return response()->json(['message' => 'Категорію не знайдено'], 404);
        }
        $category->delete();
        return response()->json(['message' => 'Категорію видалено']);
    }
}
