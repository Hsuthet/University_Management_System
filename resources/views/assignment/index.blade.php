@extends('index')

@section('content')
<x-data-table 
    title="Assignment List"
    :columns="[
        'iteration' => '#',
        'name' => 'Name',
        'department' => 'Department',
        'deadline' => 'Deadline',
        'assignment_file' => 'File'
    ]"
    tableId="assignmentTable"
    :addButton="Auth::user()->role == 2"
    addButtonLink="{{ route('assignment.create') }}"
    :actionsColumn="Auth::user()->role == 2"
>
    @foreach($assignments as $assignment)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $assignment->name }}</td>
        <td>{{ $assignment->department->name ?? '-' }}</td>
        <td>{{ $assignment->deadline }}</td>
        <td>
            @if($assignment->assignment_file)
                <a href="{{ asset('storage/'.$assignment->assignment_file) }}" target="_blank">View</a>
            @endif
        </td>
        @if(Auth::user()->role == 2)
        <td class="d-flex gap-1">
            <a href="{{ route('assignment.edit', $assignment->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
            <form action="{{ route('assignment.destroy', $assignment->id) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">  <i class="bi bi-trash3"></i></button>
            </form>
        </td>
        @endif
    </tr>
    @endforeach
</x-data-table>
@endsection
