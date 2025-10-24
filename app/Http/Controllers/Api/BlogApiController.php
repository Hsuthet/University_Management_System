<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

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
}
