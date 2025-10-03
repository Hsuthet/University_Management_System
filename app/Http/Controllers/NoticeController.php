<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use App\Models\Department;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NoticeController extends Controller
{
    // Display paginated list
    public function index()
    {
        $notices = Notice::with(['department', 'academicYear'])->latest()->paginate(10);
        return view('notices.index', compact('notices'));
    }

    // Show create form
    public function create()
    {
        $departments = Department::all();
        $academicYears = AcademicYear::all();
        return view('notices.create', compact('departments', 'academicYears'));
    }

    // Store new notice
    public function store(Request $request)
    {
        $request->validate([
            'event_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'location' => 'nullable|string|max:150',
            'notice_image' => 'nullable|image|max:2048',
            'academic_year_id' => 'required|exists:academic_years,id',
            'department_id' => 'required|exists:departments,id',
        ]);

        $data = $request->only(
            'event_name',
            'description',
            'date',
            'location',
            'academic_year_id',
            'department_id'
        );

        if ($request->hasFile('notice_image')) {
            $data['notice_image'] = $request->file('notice_image')->store('notices', 'public');
        }

        Notice::create($data);

        return redirect()->route('notices.index');
    }

    // Show edit form
    public function edit($id)
    {
        $notice = Notice::findOrFail($id);
        $departments = Department::all();
        $academicYears = AcademicYear::all();
        return view('notices.edit', compact('notice', 'departments', 'academicYears'));
    }

    // Update existing notice
    public function update(Request $request, $id)
    {
        $request->validate([
            'event_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'location' => 'nullable|string|max:150',
            'notice_image' => 'nullable|image|max:2048',
            'academic_year_id' => 'required|exists:academic_years,id',
            'department_id' => 'required|exists:departments,id',
        ]);

        $notice = Notice::findOrFail($id);

        $data = $request->only(
            'event_name',
            'description',
            'date',
            'location',
            'academic_year_id',
            'department_id'
        );

        if ($request->hasFile('notice_image')) {
            // Delete old image if exists
            if ($notice->notice_image) {
                Storage::disk('public')->delete($notice->notice_image);
            }
            $data['notice_image'] = $request->file('notice_image')->store('notices', 'public');
        }

        $notice->update($data);

        return redirect()->route('notices.index');
    }

    // Delete notice
    public function destroy($id)
    {
        $notice = Notice::findOrFail($id);

        if ($notice->notice_image) {
            Storage::disk('public')->delete($notice->notice_image);
        }

        $notice->delete();

        return redirect()->route('notices.index');
    }
}
