<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogApiController extends Controller
{
    public function blogs()
    {
        $blogs = Blog::all();
        return response()->json(['message' => 'Blogs retrieved successfully', 'blogs' => $blogs]);
    }

    public function blogDetails($id)
    {
        $blog = Blog::findOrFail($id);
        return response()->json(['message' => 'Blog details retrieved successfully', 'blog' => $blog]);
    }

    public function blogUpdate(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'content' => 'nullable|string',
        ]);

        $blog->update($validatedData);

        return response()->json(['message' => 'Blog updated successfully', 'blog' => $blog]);
    }

    public function blogDelete($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return response()->json(['message' => 'Blog deleted successfully', 'blog' => $blog]);
    }

    public function blogCreate(Request $request)
{
    $request->validate([
        'user_id' => 'required|exists:users,id', // explicitly provide user_id
        'content' => 'required|string',
        'file' => 'nullable|file|mimes:jpg,jpeg,png,gif,pdf,doc,docx,mp4|max:10240',
    ]);

    $filePath = null;
    if ($request->hasFile('file')) {
        $filePath = $request->file('file')->store('blogs', 'public');
    }

    $blog = Blog::create([
        'user_id' => $request->user_id, // take from request
        'content' => $request->content,
        'file_path' => $filePath,
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Blog post created successfully.',
        'data' => $blog
    ], 201);
}


}
