@extends('index')

@section('content')
<div class="container mt-4" style="max-width: 850px;">
    <h2 class="mb-4 text-center fw-bold text-secondary"> Discussion Board</h2>

    <!-- New Post Form -->
    <div class="card shadow-sm border-0 mb-4" style="background-color: #fafafa;">
        <div class="card-body">
            <h5 class="fw-semibold text-muted mb-3">Start a New Discussion</h5>
            <form action="{{ route('blogs.store') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <textarea 
                        name="content" 
                        class="form-control border-0 shadow-sm" 
                        rows="3" 
                        style="background-color:#fff; resize: none;" 
                        placeholder="Share your thoughts..." 
                        required>
                    </textarea>
                </div>
                <button type="submit" class="btn btn-sm px-4" style="background-color:#6c63ff; color:#fff; border-radius:10px;">
                    <i class="bi bi-megaphone"></i> Publish
                </button>
            </form>
        </div>
    </div>

    <!-- All Posts -->
    @foreach($blogs as $blog)
        <div class="card border-0 shadow-sm mb-4" style="background-color:#ffffff;">
            <div class="card-header border-0" style="background-color:#f8f9fa;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <strong class="text-dark">{{ $blog->user->name }}</strong>
                    </div>
                   @if(Auth::id() === $blog->user_id || Auth::user()->role == 1)
    <div class="d-flex gap-2">
        @if(Auth::id() === $blog->user_id)
            <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-pencil"></i>
            </a>
        @endif
        <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this post?');">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-outline-danger">
                <i class="bi bi-trash"></i>
            </button>
        </form>
    </div>
@endif

                </div>
            </div>

            <div class="card-body">
                <p class="fs-6 text-dark mb-0">{{ $blog->content }}</p>
            </div>

            <div class="card-footer border-0" style="background-color:#f9f9f9;">
                <h6 class="mb-3 text-muted fw-semibold">Comments</h6>

                @forelse($blog->comments as $comment)
                    <div class="rounded p-3 mb-2" style="background-color:#fdfdfd; border:1px solid #eee;">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <strong class="text-dark">{{ $comment->user->name }}</strong>
                                <p class="mb-1 text-muted">{{ $comment->comment }}</p>
                            </div>

                            @if(Auth::id() === $comment->user_id)
                                <div class="d-flex gap-2">
                                    <a href="{{ route('comments.edit', $comment->id) }}" 
                                       class="btn btn-sm btn-outline-secondary d-flex align-items-center">
                                        <i class="bi bi-pencil me-1"></i>
                                    </a>
                                    <form action="{{ route('comments.destroy', $comment->id) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Delete this comment?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger d-flex align-items-center">
                                            <i class="bi bi-trash me-1"></i>
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="text-muted small">No comments yet.</p>
                @endforelse

                <!-- Add Comment -->
                <form class="mt-3" action="{{ route('comments.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                    <div class="input-group">
                        <input 
                            type="text" 
                            name="comment" 
                            class="form-control border-0 shadow-sm" 
                            style="background-color:#fff;" 
                            placeholder="Write a comment..." 
                            required>
                        <button type="submit" class="btn btn-sm" style="background-color:#6c63ff; color:white; border-radius:8px;">
                            <i class="bi bi-send"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection
