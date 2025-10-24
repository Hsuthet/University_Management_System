<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentApiController extends Controller
{
    // Read all departments
    public function departments()
    {
        $departments = Department::all();

        return response()->json([
            'message' => 'Departments retrieved successfully',
            'departments' => $departments,
        ]);
    }

    // Read single department
    public function departmentDetails($id)
    {
        $department = Department::findOrFail($id);

        return response()->json([
            'message' => 'Department details retrieved successfully',
            'department' => $department,
        ]);
    }

    // Update department
    public function departmentUpdate(Request $request, $id)
    {
        $department = Department::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $department->update($validatedData);

        return response()->json([
            'message' => 'Department updated successfully',
            'department' => $department,
        ]);
    }

    // Delete department
    public function departmentDelete($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();

        return response()->json([
            'message' => 'Department deleted successfully',
            'department' => $department,
        ]);
    }
}
