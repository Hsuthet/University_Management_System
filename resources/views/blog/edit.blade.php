@extends('index')

@section('content')
<div class="container">
    <h2>Edit Blog Post</h2>

    <form action="{{ route('blogs.update', $blog->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mt-3">
            <label>Content</label>
            <textarea name="content" class="form-control" rows="5" required>{{ old('content', $blog->content) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update Post</button>
        <a href="{{ route('blogs.index') }}" class="btn btn-secondary mt-3">Cancel</a>
    </form>
</div>
@endsection
