@extends('index')

@section('content')

<x-data-table
    title="Notice List"
    :columns="[
        'iteration' => '#',
        'event_name' => 'Event',
        'description' => 'Description',
        'date' => 'Date',
        'location' => 'Location',
        'image' => 'Image',
        'academic_year' => 'Academic Year',
        'department' => 'Department'
    ]"
    tableId="noticeTable"
    :addButton="Auth::user()->role == 1"
    addButtonLink="{{ route('notices.create') }}"
    :actionsColumn="Auth::user()->role == 1"
>
    @forelse($notices as $notice)
    <tr>
        <td>{{ $loop->iteration + ($notices->currentPage() - 1) * $notices->perPage() }}</td>
        <td>{{ $notice->event_name }}</td>
        <td title="{{ $notice->description }}">{{ Str::limit($notice->description, 50) }}</td>
        <td class="text-nowrap">{{ $notice->date }}</td>
        <td>{{ $notice->location }}</td>
        <td>
            @if($notice->notice_image)
                <img src="{{ asset('storage/'.$notice->notice_image) }}" width="60">
            @else
                -
            @endif
        </td>
        <td>{{ $notice->academicYear->name ?? '-' }}</td>
        <td>{{ $notice->department->name ?? '-' }}</td>

        @if(Auth::user()->role == 1)
        <td class="d-flex gap-1">
            <a href="{{ route('notices.edit', $notice->id) }}" class="btn btn-warning btn-sm">
                <i class="bi bi-pencil-square"></i>
            </a>

            <form action="{{ route('notices.destroy', $notice->id) }}" method="POST" class="d-inline-block">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm" 
                        onclick="return confirm('Are you sure you want to delete this notice?')">
                    <i class="bi bi-trash3"></i>
                </button>
            </form>
        </td>
        @endif
    </tr>
    @empty
    <tr>
        <td colspan="{{ Auth::user()->role == 1 ? 9 : 8 }}" class="text-center">No notices found</td>
    </tr>
    @endforelse
</x-data-table>

@endsection
