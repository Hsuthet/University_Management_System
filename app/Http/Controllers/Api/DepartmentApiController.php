<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Resources\DepartmentResource;

class DepartmentApiController extends Controller
{
    // Read all departments
    public function departments()
    {
        // $departments = Department::all();

        // return response()->json([
        //     'message' => 'Departments retrieved successfully',
        //     'departments' => $departments,
        // ]);

        $departments = Department::all()
        ->filter(fn($department) => $department->id % 2 == 0) // Even only
        ->values(); // re-index
 
    return DepartmentResource::collection($departments);
    }

    // Read single department
    public function departmentDetails($id)
    {
        $department = Department::findOrFail($id);
return new DepartmentResource($department);
        // return response()->json([
        //     'message' => 'Department details retrieved successfully',
        //     'department' => $department,
        // ]);
    }

    // Update department
    public function departmentUpdate(Request $request, $id)
    {
        //return $id;
        $department = Department::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'nullable|string',
        ]);
            return $validatedData;
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

    public function departmentCreate(Request $request)
    {
         

        $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'nullable|string',
        ]);
            
        $department = new Department();
        $department->name = $request->name;
        $department->content = $request->content;
        $department->save();


        return response()->json([
            'message' => 'Department created successfully',
            'department' => $department,
        ]);
    }
}
