<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Assignment;
use Illuminate\Support\Facades\Storage;

class AssignmentController extends Controller
{
    // Display paginated list
    public function index()
    {
        $assignments = Assignment::with('department')->paginate(10);
        return view('assignment.index', compact('assignments'));
    }

    // Show create form
    public function create()
    {
        $departments = Department::all();
        return view('assignment.create', compact('departments'));
    }

    // Store new assignment
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'deadline' => 'required|date',
            'assignment_file' => 'nullable|file|mimes:pdf,doc,docx',
        ]);

        $data = $request->only('name', 'department_id', 'deadline');

        if ($request->hasFile('assignment_file')) {
            $data['assignment_file'] = $request->file('assignment_file')->store('assignments', 'public');
        }

        Assignment::create($data);

        return redirect()->route('assignment.index');
    }

    // Show edit form
    public function edit($id)
    {
        $assignment = Assignment::findOrFail($id);
        $departments = Department::all();
        return view('assignment.edit', compact('assignment', 'departments'));
    }

    // Update assignment
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'deadline' => 'required|date',
            'assignment_file' => 'nullable|file|mimes:pdf,doc,docx',
        ]);

        $assignment = Assignment::findOrFail($id);

        $data = $request->only('name', 'department_id', 'deadline');

        if ($request->hasFile('assignment_file')) {
            // Delete old file if exists
            if ($assignment->assignment_file) {
                Storage::disk('public')->delete($assignment->assignment_file);
            }
            $data['assignment_file'] = $request->file('assignment_file')->store('assignments', 'public');
        }

        $assignment->update($data);

       return redirect()->route('assignment.index');
    }

    // Delete assignment
    public function destroy($id)
    {
        $assignment = Assignment::findOrFail($id);

        if ($assignment->assignment_file) {
            Storage::disk('public')->delete($assignment->assignment_file);
        }

        $assignment->delete();

        return redirect()->route('assignment.index');
    }
}
