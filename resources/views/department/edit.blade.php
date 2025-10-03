@extends('index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Department</div>

                <div class="card-body">
                    <form action="{{ route('department.update', $department->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        {{-- Name --}}
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $department->name) }}">
                            @error('name')<p class="text-danger">{{ $message }}</p>@enderror
                        </div>

                        {{-- Content --}}
                        <div class="mb-3">
                            <label class="form-label">Content</label>
                            <textarea name="content" class="form-control">{{ old('content', $department->content) }}</textarea>
                            @error('content')<p class="text-danger">{{ $message }}</p>@enderror
                        </div>

                        {{-- Logo --}}
                        <div class="mb-3">
                            <label class="form-label">Logo</label>
                            <input type="file" name="logo" class="form-control">
                            @if($department->logo)
                                <img src="{{ asset('storage/'.$department->logo) }}" alt="Logo" width="100" class="mt-2">
                            @endif
                            @error('logo')<p class="text-danger">{{ $message }}</p>@enderror
                        </div>

                        <button class="btn btn-primary">Update</button>
                        <a href="{{ route('department.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
