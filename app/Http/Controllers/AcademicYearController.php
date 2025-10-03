<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AcademicYear;

class AcademicYearController extends Controller
{
    // Display paginated list
    public function index(){
        $academicYears = AcademicYear::paginate(10);
        return view('academic_years.index', compact('academicYears'));
    }

    // Show create form
    public function create(){
        return view('academic_years.create'); 
    }

    // Store new academic year
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'semester_name' => 'required|string|max:255',
        ]);

        $academicYear = new AcademicYear();
        $academicYear->name = $request->name;
        $academicYear->semester_name = $request->semester_name;
        $academicYear->save();

          return redirect()->route('academicyear.index');
    }

    // Delete academic year
    public function destroy($id)
    {
        $academicYear = AcademicYear::find($id);
        $academicYear->delete();
        return back();
    }

    // Show edit form
    public function edit($id)
    {
        $academicYear = AcademicYear::find($id);
        return view('academic_years.edit', compact('academicYear'));
    }

    // Update academic year
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'semester_name' => 'required|string|max:255',
        ]);

        $academicYear = AcademicYear::find($id);
        $academicYear->name = $request->name;
        $academicYear->semester_name = $request->semester_name;
        $academicYear->update();

        return redirect()->route('academicyear.index');
    }
}
