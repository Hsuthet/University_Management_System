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
}
