@extends('index')

@section('content')
<div class="container py-3">

    <!-- ========================== -->
    <!-- PAGE HEADER -->
    <!-- ========================== -->
    <h1 class="fw-bolder text-dark mb-5 display-6 text-center">Discussion Dashboard</h1>

    <!-- ========================== -->
    <!-- CREATE POST -->
    <!-- ========================== -->
    <div class="card border-0 shadow-lg mb-5 rounded-4 bg-white">
        <div class="card-body p-4 d-flex gap-3">
            <!-- Avatar -->
            <div class="rounded-circle overflow-hidden flex-shrink-0" style="width:50px; height:50px;">
                @if(Auth::user()->profile_image)
                    <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" alt="{{ Auth::user()->name }}" class="w-100 h-100 object-fit-cover">
                @else
                    <div class="bg-primary text-white d-flex justify-content-center align-items-center h-100 w-100 fs-5 fw-bold">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                @endif
            </div>

            <!-- Form -->
            <form class="flex-grow-1" action="{{ route('blogs.store') }}" method="POST">
                @csrf
                <textarea 
                    name="content"
                    class="form-control border-0 bg-light p-3 pt-4 shadow-sm" 
                    rows="3"
                    placeholder="What's on your mind, {{ strtok(Auth::user()->name, ' ') }}?"
                    style="border-radius: 20px; resize: none; line-height:1.5; font-size:1.05rem;" 
                    required></textarea>

                <div class="d-flex justify-content-end mt-3">
                    <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill fw-semibold shadow-sm">
                        <i class="bi bi-send-fill me-1"></i> Post
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ========================== -->
    <!-- FEED HEADER -->
    <!-- ========================== -->
    <h3 class="fw-bold text-dark mb-4 mt-5 border-bottom border-light pb-2">Recent Activity</h3>

    <!-- ========================== -->
    <!-- FEED POSTS -->
    <!-- ========================== -->
    @forelse($blogs as $blog)
        <div class="card border-0 shadow-sm mb-4 rounded-4 bg-white">
            <div class="card-body p-4">

                <!-- Post Header -->
                <div class="d-flex align-items-start gap-3 mb-2">
                    <!-- Avatar -->
                    <div class="rounded-circle overflow-hidden flex-shrink-0" style="width:45px; height:45px;">
                        @if($blog->user->profile_image)
                            <img src="{{ asset('storage/' . $blog->user->profile_image) }}" alt="{{ $blog->user->name }}" class="w-100 h-100 object-fit-cover">
                        @else
                            <div class="bg-secondary text-white d-flex justify-content-center align-items-center h-100 w-100 fw-bold">
                                {{ strtoupper(substr($blog->user->name, 0, 1)) }}
                            </div>
                        @endif
                    </div>

                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <a href="#" class="text-dark fw-bold text-decoration-none hover-primary">{{ $blog->user->name }}</a>
                                <div class="text-muted small mt-1">{{ $blog->created_at->diffForHumans() }}</div>
                            </div>

                            <!-- Post Actions -->
                           <!-- Post Actions -->
@if(Auth::id() === $blog->user_id || Auth::user()->role == 1)
    <div class="dropdown">
        <button class="btn btn-light btn-sm rounded-circle p-1" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="width:30px; height:30px;">
            <i class="bi bi-three-dots"></i>
        </button>
        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
            <!-- Only post owner can edit -->
            @if(Auth::id() === $blog->user_id)
                <li>
                    <a class="dropdown-item" href="{{ route('blogs.edit', $blog->id) }}">
                        <i class="bi bi-pencil me-2"></i> Edit Post
                    </a>
                </li>
            @endif

            <!-- Post owner OR admin can delete -->
            <li>
                <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" onsubmit="return confirm('Delete this post?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="dropdown-item text-danger">
                        <i class="bi bi-trash me-2"></i> Delete Post
                    </button>
                </form>
            </li>
        </ul>
    </div>
@endif


                        </div>

                        <!-- Post Content -->
                        <p class="mt-2 fs-6 text-dark" style="white-space: pre-line; line-height:1.5;">{{ $blog->content }}</p>

                        <!-- Like/Comment placeholder -->
                        <div class="d-flex gap-3 pt-2 border-top border-light mt-2">
                            <button class="btn btn-sm text-muted fw-semibold p-0"><i class="bi bi-hand-thumbs-up me-1"></i> Like</button>
                            <button class="btn btn-sm text-muted fw-semibold p-0"><i class="bi bi-chat me-1"></i> Comment</button>
                        </div>

                        <!-- Comments Section -->
                        <div class="mt-3">
                            @forelse($blog->comments as $comment)
                                <div class="d-flex align-items-start gap-2 mb-3">
                                    <div class="rounded-circle overflow-hidden flex-shrink-0" style="width:38px; height:38px;">
                                        @if($comment->user->profile_image)
                                            <img src="{{ asset('storage/' . $comment->user->profile_image) }}" alt="{{ $comment->user->name }}" class="w-100 h-100 object-fit-cover">
                                        @else
                                            <div class="bg-light text-secondary d-flex justify-content-center align-items-center h-100 w-100 small fw-bold">
                                                {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="flex-grow-1">
                                        <div class="bg-light rounded-3 p-2 px-3 shadow-sm">
                                            <div class="d-flex justify-content-between align-items-start mb-1">
                                                <div class="lh-sm">
                                                    <strong class="text-dark small fw-semibold">{{ $comment->user->name }}</strong>
                                                    <small class="text-secondary ms-2" style="font-size: 0.75rem;">{{ $comment->created_at->diffForHumans() }}</small>
                                                </div>

                                                @if(Auth::id() === $comment->user_id)
                                                    <div class="dropdown ms-2">
                                                        <button class="btn btn-sm text-muted rounded-circle p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false" title="Comment Actions" style="width:24px; height:24px;">
                                                            <i class="bi bi-three-dots-vertical small"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                                            <li>
                                                                <a class="dropdown-item small" href="{{ route('comments.edit', $comment->id) }}">
                                                                    <i class="bi bi-pencil me-2"></i> Edit Comment
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Delete this comment?');">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="dropdown-item small text-danger">
                                                                        <i class="bi bi-trash me-2"></i> Delete Comment
                                                                    </button>
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                @endif
                                            </div>
                                            <p class="mb-0 small text-dark mt-1" style="line-height:1.4;">{{ $comment->comment }}</p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-muted small ms-1 mb-2">Be the first to comment!</p>
                            @endforelse

                            <!-- Add Comment -->
                            <form action="{{ route('comments.store') }}" method="POST" class="mt-2">
                                @csrf
                                <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                                <div class="input-group shadow-sm">
                                    <input type="text" name="comment" class="form-control border-0 rounded-start-pill py-2" placeholder="Write a comment..." required>
                                    <button type="submit" class="btn btn-primary rounded-end-pill px-3 py-2">
                                        <i class="bi bi-arrow-up-circle-fill"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <!-- End Comments Section -->

                    </div>
                </div>
            </div>
        </div>
    @empty
        <p class="text-center text-muted mt-5">No posts yet. Start the conversation!</p>
    @endforelse

</div>
@endsection
