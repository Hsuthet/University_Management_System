@extends('index')

@section('content')
<div class="container py-4">

    <h1 class="fw-bolder text-dark mb-5 display-6 text-center">
        <i class="bi bi-chat-dots text-primary me-2"></i> Discussion Dashboard
    </h1>

    <!-- Create New Post -->
    <div class="card border-0 shadow-lg mb-5 rounded-4 bg-white hover-card">
        <div class="card-body p-4 d-flex gap-3">
            <!-- Avatar -->
            <a href="{{ route('user.profile', Auth::id()) }}">
                <div class="rounded-circle overflow-hidden flex-shrink-0 mt-1 shadow-sm border" style="width:48px; height:48px;">
                    @if(Auth::user()->profile_image)
                        <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" class="w-100 h-100 object-fit-cover">
                    @else
                        <div class="bg-primary text-white d-flex justify-content-center align-items-center h-100 w-100 fs-5 fw-bold">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    @endif
                </div>
            </a>

            <!-- Post Form -->
            <form class="flex-grow-1" action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <textarea name="content" class="form-control border-0 bg-light p-3 pt-4 rounded-3 mb-2 shadow-sm"
                          rows="3" placeholder="What's on your mind, {{ strtok(Auth::user()->name, ' ') }}?"
                          style="resize:none; font-size:1rem;" required></textarea>

                <div class="d-flex justify-content-between align-items-center">
                    <input type="file" name="file" class="form-control form-control-sm w-75" accept="image/*,video/*,.pdf,.doc,.docx">
                    <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill fw-semibold shadow-sm">
                        <i class="bi bi-send-fill me-1"></i> Post
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Blog Feed -->
    @forelse($blogs as $blog)
    <div class="card border-0 shadow-sm mb-4 rounded-4 bg-white hover-card">
        <div class="card-body p-4">

            <!-- Header -->
            <div class="d-flex align-items-start justify-content-between mb-3">
                <div class="d-flex align-items-center gap-3">
                    <a href="{{ route('user.profile', $blog->user->id) }}">
                        <div class="rounded-circle overflow-hidden shadow-sm border" style="width:45px; height:45px;">
                            @if($blog->user->profile_image)
                                <img src="{{ asset('storage/' . $blog->user->profile_image) }}" class="w-100 h-100 object-fit-cover">
                            @else
                                <div class="bg-secondary text-white d-flex justify-content-center align-items-center h-100 w-100 fw-bold">
                                    {{ strtoupper(substr($blog->user->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                    </a>
                    <div>
                        <a href="{{ route('user.profile', $blog->user->id) }}" class="fw-semibold text-dark text-decoration-none">
                            {{ $blog->user->name }}
                        </a>
                        <div class="text-muted small">{{ $blog->created_at->diffForHumans() }}</div>
                    </div>
                </div>

                @if(Auth::id() === $blog->user_id || Auth::user()->role == 1)
                <div class="dropdown">
                    <button class="btn btn-light btn-sm rounded-circle p-1" data-bs-toggle="dropdown">
                        <i class="bi bi-three-dots"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                        @if(Auth::id() === $blog->user_id)
                            <li><a class="dropdown-item" href="{{ route('blogs.edit', $blog->id) }}"><i class="bi bi-pencil me-2"></i>Edit Post</a></li>
                        @endif
                        <li>
                            <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" onsubmit="return confirm('Delete this post?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-item text-danger"><i class="bi bi-trash me-2"></i>Delete</button>
                            </form>
                        </li>
                    </ul>
                </div>
                @endif
            </div>

            <!-- Post Content -->
            <p class="fs-6 mb-3 text-dark" style="white-space: pre-line;">{{ $blog->content }}</p>

            @if($blog->file_path)
                @if(Str::endsWith($blog->file_path, ['jpg','jpeg','png','gif']))
                    <div class="text-center mb-3">
                        <img src="{{ asset('storage/'.$blog->file_path) }}" class="img-fluid rounded shadow-sm" style="max-height:400px; object-fit:cover;">
                    </div>
                @elseif(Str::endsWith($blog->file_path, ['mp4','mov']))
                    <div class="text-center mb-3">
                        <video controls class="rounded w-100 shadow-sm" style="max-height:400px;">
                            <source src="{{ asset('storage/'.$blog->file_path) }}" type="video/mp4">
                        </video>
                    </div>
                @else
                    <a href="{{ asset('storage/'.$blog->file_path) }}" target="_blank" class="btn btn-outline-secondary btn-sm mb-2">
                        <i class="bi bi-paperclip me-1"></i> View File
                    </a>
                @endif
            @endif

            <!-- Actions -->
            <div class="d-flex gap-3 border-top pt-2">
                <button class="btn btn-light btn-sm hover-btn"><i class="bi bi-hand-thumbs-up"></i> Like</button>
                <button class="btn btn-light btn-sm hover-btn" data-bs-toggle="collapse" data-bs-target="#comments-{{ $blog->id }}">
                    <i class="bi bi-chat"></i> Comments ({{ $blog->comments->count() }})
                </button>
            </div>

            <!-- Comments -->
            <div class="collapse mt-3" id="comments-{{ $blog->id }}">
                @forelse($blog->comments as $comment)
                    <div class="d-flex gap-2 mb-3 position-relative">
                        <div class="rounded-circle overflow-hidden flex-shrink-0 shadow-sm border" style="width:32px; height:32px;">
                            @if($comment->user->profile_image)
                                <img src="{{ asset('storage/' . $comment->user->profile_image) }}" class="w-100 h-100 object-fit-cover">
                            @else
                                <div class="bg-light text-secondary d-flex justify-content-center align-items-center h-100 w-100 small fw-bold">
                                    {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>

                        <div class="flex-grow-1">
                            <div class="bg-light rounded-3 p-2 shadow-sm position-relative">
                                <div class="d-flex justify-content-between">
                                    <strong class="small">{{ $comment->user->name }}</strong>
                                    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                </div>
                                <p class="mb-0 small text-dark">{{ $comment->comment }}</p>
                            </div>
                        </div>

                        <!-- Comment Dropdown -->
                        @if(Auth::id() === $comment->user_id || Auth::id() === $blog->user_id)
                        <div class="dropdown position-absolute end-0 me-2 mt-1">
                            <button class="btn btn-light btn-sm rounded-circle p-1" data-bs-toggle="dropdown" style="width:24px; height:24px;">
                                <i class="bi bi-three-dots-vertical small"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                @if(Auth::id() === $comment->user_id)
                                    <li>
                                        <a href="{{ route('comments.edit', $comment->id) }}" class="dropdown-item">
                                            <i class="bi bi-pencil me-2"></i>Edit
                                        </a>
                                    </li>
                                @endif
                                <li>
                                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Delete this comment?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger"><i class="bi bi-trash me-2"></i>Delete</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        @endif
                    </div>
                @empty
                    <p class="text-muted small ms-1 mb-2">No comments yet. Be the first!</p>
                @endforelse

                <!-- Comment Form -->
                <form action="{{ route('comments.store') }}" method="POST" class="mt-2">
                    @csrf
                    <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                    <div class="input-group shadow-sm">
                        <input type="text" name="comment" class="form-control rounded-start-pill" placeholder="Write a comment..." required>
                        <button type="submit" class="btn btn-primary rounded-end-pill"><i class="bi bi-send-fill"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @empty
        <div class="text-center text-muted py-5">
            <i class="bi bi-chat-left-text fs-1 d-block mb-2"></i>
            <p>No posts yet. Start the conversation!</p>
        </div>
    @endforelse
</div>

<style>
.hover-card { transition: all 0.3s ease; }
.hover-card:hover { transform: translateY(-3px); box-shadow: 0 8px 20px rgba(0,0,0,0.08); }
.hover-btn:hover { background-color: #e9ecef; }
</style>
@endsection
