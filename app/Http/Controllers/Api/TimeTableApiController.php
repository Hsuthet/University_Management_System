<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TimeTable;
use Illuminate\Http\Request;

class TimeTableApiController extends Controller
{
    public function timeTables()
    {
        $tables = TimeTable::all();
        return response()->json(['message' => 'Timetables retrieved successfully', 'timetables' => $tables]);
    }

    public function timeTableDetails($id)
    {
        $table = TimeTable::findOrFail($id);
        return response()->json(['message' => 'Timetable details retrieved successfully', 'timetable' => $table]);
    }

    public function timeTableUpdate(Request $request, $id)
    {
        $table = TimeTable::findOrFail($id);

        $validatedData = $request->validate([
            'day' => 'sometimes|required|string|max:255',
            'subject' => 'nullable|string|max:255',
            'start_time' => 'nullable',
            'end_time' => 'nullable',
        ]);

        $table->update($validatedData);

        return response()->json(['message' => 'Timetable updated successfully', 'timetable' => $table]);
    }

    public function timeTableDelete($id)
    {
        $table = TimeTable::findOrFail($id);
        $table->delete();

        return response()->json(['message' => 'Timetable deleted successfully', 'timetable' => $table]);
    }

    public function timeTableCreate(Request $request)
{

    $request->validate([
        'department_id' => 'required|exists:departments,id',
        'academic_year_id' => 'required|exists:academic_years,id',
        'teacher' => 'required|string|max:100',
        'day' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday',
        'start_time' => 'required|date_format:H:i',
        'end_time' => 'required|date_format:H:i|after:start_time',
    ]);

    $timetable = new Timetable();
    $timetable->department_id = $request->department_id;
    $timetable->academic_year_id = $request->academic_year_id;
    $timetable->teacher = $request->teacher;
    $timetable->day = $request->day;
    $timetable->start_time = $request->start_time;
    $timetable->end_time = $request->end_time;

    $timetable->save();

    return response()->json([
        'message' => 'Timetable entry created successfully',
        'timetable' => $timetable,
    ], 201);
}

}
