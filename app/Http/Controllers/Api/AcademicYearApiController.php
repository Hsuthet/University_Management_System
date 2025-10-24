<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use Illuminate\Http\Request;

class AcademicYearApiController extends Controller
{
    public function academicYears()
    {
        $years = AcademicYear::all();
        return response()->json(['message' => 'Academic years retrieved successfully', 'academic_years' => $years]);
    }

    public function academicYearDetails($id)
    {
        $year = AcademicYear::findOrFail($id);
        return response()->json(['message' => 'Academic year details retrieved successfully', 'academic_year' => $year]);
    }

    public function academicYearUpdate(Request $request, $id)
    {
        $year = AcademicYear::findOrFail($id);

        $validatedData = $request->validate([
            'year_name' => 'sometimes|required|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
        ]);

        $year->update($validatedData);

        return response()->json(['message' => 'Academic year updated successfully', 'academic_year' => $year]);
    }

    public function academicYearDelete($id)
    {
        $year = AcademicYear::findOrFail($id);
        $year->delete();

        return response()->json(['message' => 'Academic year deleted successfully', 'academic_year' => $year]);
    }
}
