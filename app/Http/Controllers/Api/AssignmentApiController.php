<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use Illuminate\Http\Request;

class AssignmentApiController extends Controller
{
    public function assignments()
    {
        $assignments = Assignment::all();
        return response()->json(['message' => 'Assignments retrieved successfully', 'assignments' => $assignments]);
    }

    public function assignmentDetails($id)
    {
        $assignment = Assignment::findOrFail($id);
        return response()->json(['message' => 'Assignment details retrieved successfully', 'assignment' => $assignment]);
    }

    public function assignmentUpdate(Request $request, $id)
    {
        $assignment = Assignment::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);

        $assignment->update($validatedData);

        return response()->json(['message' => 'Assignment updated successfully', 'assignment' => $assignment]);
    }

    public function assignmentDelete($id)
    {
        $assignment = Assignment::findOrFail($id);
        $assignment->delete();

        return response()->json(['message' => 'Assignment deleted successfully', 'assignment' => $assignment]);
    }
}
