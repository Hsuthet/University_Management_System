@extends('index')

@section('content')

<x-data-table
    title="Timetable List"
    :columns="[
        'iteration' => '#',
        'department' => 'Department',
        'academic_year' => 'Academic Year',
        'teacher' => 'Teacher',
        'day' => 'Day',
        'start_time' => 'Start Time',
        'end_time' => 'End Time'
    ]"
    tableId="timetableTable"
    :addButton="Auth::user()->role == 1"
    addButtonLink="{{ route('timetable.create') }}"
    :actionsColumn="Auth::user()->role == 1"
>
    @foreach($timetables as $timetable)
    <tr>
        <td>{{ $loop->iteration + ($timetables->currentPage() - 1) * $timetables->perPage() }}</td>
        <td>{{ $timetable->department->name ?? '-' }}</td>
        <td>{{ $timetable->academicYear->name ?? '-' }}</td>
        <td>{{ $timetable->teacher }}</td>
        <td>{{ $timetable->day }}</td>
        <td>{{ $timetable->start_time }}</td>
        <td>{{ $timetable->end_time }}</td>

        @if(Auth::user()->role == 1)
        <td>
            <a href="{{ route('timetable.edit', $timetable->id) }}" class="btn btn-warning btn-sm">
                <i class="bi bi-pencil-square"></i>
            </a>

            <form action="{{ route('timetable.destroy', $timetable->id) }}" 
                  method="POST" class="d-inline-block"
                  onsubmit="return confirm('Are you sure you want to delete this timetable?');">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm">
                    <i class="bi bi-trash3"></i>
                </button>
            </form>
        </td>
        @endif
    </tr>
    @endforeach
</x-data-table>

@endsection
