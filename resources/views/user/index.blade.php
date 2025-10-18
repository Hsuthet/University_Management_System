@extends('index')

@section('content')

<style>
    /* Green highlight style */
    .highlight-green {
        background-color: #a3e635; /* light green */
        padding: 2px 4px;
        border-radius: 3px;
        font-weight: bold;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">

                {{-- Header with title, search bar, and button --}}
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <h5 class="mb-0 fw-bold">User List</h5>

                        {{-- Search Bar --}}
                        <form action="{{ route('user.index') }}" method="GET" class="d-flex me-2">
                            <input type="text" name="search" value="{{ request('search') }}"
                                class="form-control form-control-sm me-2"
                                placeholder="Search User...">
                            <button type="submit" class="btn btn-secondary btn-sm">Search</button>
                        </form>

                        @if(Auth::user()->role == 1)
                        <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm">
                            + Add User
                        </a>
                    @endif

                    </div>
                </div>

                <div class="card-body">
                    {{-- Scrollable Table --}}
                    <div class="table-responsive">

                        @php
                            // Helper function to highlight matched text in green
                            function highlight($text, $search) {
                                if (!$search) return $text;
                                return preg_replace(
                                    "/(" . preg_quote($search, '/') . ")/i",
                                    '<span class="highlight-green">$1</span>',
                                    $text
                                );
                            }
                        @endphp

                        <table class="table table-bordered table-striped">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Department</th>
                                    <th class="text-nowrap">Academic Year</th>
                                    <th>Phone</th>
                                    <th>Age</th>
                                    <th>Father Name</th>
                                    <th>Gender</th>
                                    <th>NRC</th>
                                    @if(Auth::user()->role == 1)
    <th>Action</th>
@endif

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{!! highlight($user->name, request('search')) !!}</td>
                                    <td>{!! highlight($user->email, request('search')) !!}</td>
                                    <td>{!! highlight($user->role, request('search')) !!}</td>
                                    <td>{!! highlight($user->department->name ?? '-', request('search')) !!}</td>
                                    <td>{!! highlight($user->academicYear->name ?? '-', request('search')) !!}</td>
                                    <td>{!! highlight($user->phone_number, request('search')) !!}</td>
                                    <td>{!! highlight($user->age, request('search')) !!}</td>
                                    <td>{!! highlight($user->father_name, request('search')) !!}</td>
                                    <td>{!! highlight($user->gender, request('search')) !!}</td>
                                    <td>{!! highlight($user->nrc, request('search')) !!}</td>
                                    @if(Auth::user()->role == 1)
    <td>
        <a href="{{ route('users.edit',$user->id) }}" class="btn btn-warning btn-sm text-black">
            <i class="bi bi-pencil-square"></i> Edit
        </a>
        <form action="{{route('user.destroy',$user->id) }}" method="post" class="d-inline-block">
            @csrf
            @method('delete')
            <button class="btn btn-danger btn-sm text-white"
                onclick="return confirm('Are you sure you want to delete this user?')">
                <i class="bi bi-trash3"></i> Delete
            </button>
        </form>
    </td>
@endif

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination with search query persistence --}}
                    <div class="mt-2">
                        {{ $users->appends(request()->input())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
