<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;



class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $blogs = Blog::with(['user', 'comments.user'])->latest()->get();
        return view('blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   public function store(Request $request)
{
    // 1️⃣ Validate input
    $request->validate([
        'content' => 'required|string',
        'file' => 'nullable|file|mimes:jpg,jpeg,png,gif,pdf,doc,docx,mp4|max:10240', // 10MB max
    ]);

    // 2️⃣ Handle file upload if it exists
    $filePath = null;
    if ($request->hasFile('file')) {
        $filePath = $request->file('file')->store('blogs', 'public');
    }

    // 3️⃣ Create the blog post
    Blog::create([
        'user_id' => Auth::id(),
        'content' => $request->content,
        'file_path' => $filePath,
    ]);

    // 4️⃣ Redirect back with success message
    return back()->with('success', 'Post published successfully!');
}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          $blog = Blog::findOrFail($id);
        return view('blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
{
    $request->validate([
        'content' => 'required|string|max:5000',
    ]);

    if ($blog->user_id !== Auth::id()) {
        return redirect()->route('blogs.index')->with('error', 'You are not authorized to update this post.');
    }

    $blog->update([
        'content' => $request->content,
    ]);

    return redirect()->route('blogs.index')->with('success', 'Blog post updated successfully!');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
public function destroy($id)
{
    $blog = Blog::findOrFail($id);

    // Only owner or admin can delete
    if (Auth::id() !== $blog->user_id && Auth::user()->role != 1) {
        abort(403, 'Unauthorized action.');
    }

    $blog->delete();
    return redirect()->back()->with('success', 'Post deleted successfully.');
}


}
