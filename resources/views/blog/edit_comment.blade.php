@extends('index')

@section('content')
<div class="container">
    <h2>Edit Comment</h2>

    <form action="{{ route('comments.update', $comment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mt-3">
            {{-- <label>Comment</label> --}}
            <textarea name="comment" class="form-control" rows="3" required>{{ old('comment', $comment->comment) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update Comment</button>
        <a href="{{ route('blogs.index') }}" class="btn btn-secondary mt-3">Cancel</a>
    </form>
</div>
@endsection
