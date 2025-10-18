<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
          $request->validate([
            'blog_id' => 'required|exists:blogs,id',
            'comment' => 'required|string|max:1000',
        ]);

        Comment::create([
            'blog_id' => $request->blog_id,
            'user_id' => Auth::id(),
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Comment added!');
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
         $comment = Comment::findOrFail($id);
        return view('blog.edit_comment', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
{
    $request->validate([
        'comment' => 'required|string|max:5000',
    ]);

    if ($comment->user_id !== Auth::id()) {
        return redirect()->back()->with('error', 'You are not authorized to update this comment.');
    }

    $comment->update([
        'comment' => $request->comment,
    ]);

  return redirect()->route('blogs.index')->with('success', 'Comment updated successfully!');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function destroy($id)
{
    $comment = Comment::findOrFail($id);

    if ($comment->user_id === Auth::id()) {
        $comment->delete();
        return back()->with('success', 'Comment deleted.');
    }

    return back()->with('error', 'You are not authorized to delete this comment.');
}

}
