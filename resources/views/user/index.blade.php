@extends('index')

@section('content')

<style>
    /* Green highlight style for search matches */
    .highlight-green {
        background-color: #a3e635; /* light green */
        padding: 2px 4px;
        border-radius: 3px;
        font-weight: bold;
    }
</style>

@php
// Helper: Highlight search term
function highlight($text, $search) {
    if (!$search) return $text;
    return preg_replace(
        "/(" . preg_quote($search, '/') . ")/i",
        '<span class="highlight-green">$1</span>',
        $text
    );
}

// Helper: Convert role number to readable text
function formatRole($role) {
    return match((int)$role) {
        1 => 'Admin',
        2 => 'Teacher',
        3 => 'Student',
        default => 'Unknown',
    };
}
@endphp

<x-data-table
    title="User List"
    :columns="[
        'iteration' => '#',
        'name' => 'Name',
        'email' => 'Email',
        'role' => 'Role',
        'department' => 'Department',
        'academic_year' => 'Academic Year',
        'phone' => 'Phone',
        'age' => 'Age',
        'father_name' => 'Father Name',
        'gender' => 'Gender',
        'nrc' => 'NRC'
    ]"
    tableId="userTable"
    :addButton="Auth::user()->role == 1"
    addButtonLink="{{ route('user.create') }}"
    :actionsColumn="Auth::user()->role == 1"
>
    @foreach($users as $user)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{!! highlight($user->name, request('search')) !!}</td>
        <td>{!! highlight($user->email, request('search')) !!}</td>
        <td>{!! highlight(formatRole($user->role), request('search')) !!}</td>
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
                <i class="bi bi-pencil-square"></i>
            </a>
            <form action="{{ route('user.destroy', $user->id) }}" method="post" class="d-inline-block">
                @csrf
                @method('delete')
                <button class="btn btn-danger btn-sm text-white"
                    onclick="return confirm('Are you sure you want to delete this user?')">
                    <i class="bi bi-trash3"></i> 
                </button>
            </form>
        </td>
        @endif
    </tr>
    @endforeach
</x-data-table>

@endsection
