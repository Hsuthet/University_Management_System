<?php

namespace App\Http\Controllers;

use App\Models\Timetable;
use App\Models\Department;
use App\Models\AcademicYear;
use Illuminate\Http\Request;

class TimetableController extends Controller
{
    // Display a paginated list of timetable entries
    public function index()
    {
        $timetables = Timetable::with(['department', 'academicYear'])
            ->orderBy('day')
            ->orderBy('start_time')
            ->paginate(1);

        return view('timetable.index', compact('timetables'));
    }

    // Show the form for creating a new timetable entry
    public function create()
    {
        $departments = Department::all();
        $academicYears = AcademicYear::all();

        return view('timetable.create', compact('departments', 'academicYears'));
    }

    // Store a newly created timetable entry
    public function store(Request $request)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'academic_year_id' => 'required|exists:academic_years,id',
            'teacher' => 'required|string|max:100',
            'day' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);

        $data = $request->only(
            'department_id',
            'academic_year_id',
            'teacher',
            'day',
            'start_time',
            'end_time'
        );

        Timetable::create($data);

        return redirect()->route('timetable.index');
    }

    // Show a specific timetable entry
    public function show($id)
    {
        $timetable = Timetable::with(['department', 'academicYear'])->findOrFail($id);

        return view('timetable.show', compact('timetable'));
    }

    // Show the form for editing a timetable entry
   public function edit($id)
{
    

    $timetable = Timetable::findOrFail($id);
    $departments = Department::all();
    $academicYears = AcademicYear::all();
   
    return view('timetable.edit', compact('timetable', 'departments', 'academicYears'));
}


    // Update a timetable entry
    public function update(Request $request, $id)
    {
        $timetable = Timetable::findOrFail($id);

        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'academic_year_id' => 'required|exists:academic_years,id',
            'teacher' => 'required|string|max:100',
            'day' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);

        $data = $request->only(
            'department_id',
            'academic_year_id',
            'teacher',
            'day',
            'start_time',
            'end_time'
        );

        $timetable->update($data);

        return redirect()->route('timetable.index');
    }

    // Delete a timetable entry
    public function destroy($id)
    {
        $timetable = Timetable::findOrFail($id);
        $timetable->delete();

        return redirect()->route('timetable.index');
    }
}
