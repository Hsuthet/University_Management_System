@extends('index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Department</div>

                <div class="card-body">
                    <form action="{{ route('department.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        {{-- Name --}}
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                            @error('name')<p class="text-danger">{{ $message }}</p>@enderror
                        </div>

                        {{-- Content --}}
                        <div class="mb-3">
                            <label class="form-label">Content</label>
                            <textarea name="content" class="form-control">{{ old('content') }}</textarea>
                            @error('content')<p class="text-danger">{{ $message }}</p>@enderror
                        </div>

                        {{-- Logo --}}
                        <div class="mb-3">
                            <label class="form-label">Logo</label>
                            <input type="file" name="logo" class="form-control">
                            @error('logo')<p class="text-danger">{{ $message }}</p>@enderror
                        </div>

                        <button class="btn btn-primary">Create</button>
                        <a href="{{ route('department.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
