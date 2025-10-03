<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\Storage;

class DepartmentController extends Controller
{
    // Display paginated list
   public function index(Request $request)
{
    $search = $request->input('search');

    $departments = Department::when($search, function($query, $search) {
        return $query->where('name', 'like', "%{$search}%")
                     ->orWhere('content', 'like', "%{$search}%");
    })->paginate(10);

    return view('department.index', compact('departments'));
}


    // Show create form
    public function create() {
        return view('department.create');
    }

    // Store new department
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $data = $request->only('name', 'content');

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('departments', 'public');
        }

        Department::create($data);

        return redirect()->route('department.index');
    }

    // Show edit form
    public function edit($id) {
        $department = Department::findOrFail($id);
        return view('department.edit', compact('department'));
    }

    // Update department
    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $department = Department::findOrFail($id);

        $data = $request->only('name', 'content');

        if ($request->hasFile('logo')) {
            if ($department->logo) {
                Storage::disk('public')->delete($department->logo);
            }
            $data['logo'] = $request->file('logo')->store('departments', 'public');
        }

        $department->update($data);

        return redirect()->route('department.index');
    }

    // Delete department
    public function destroy($id) {
        $department = Department::findOrFail($id);

        if ($department->logo) {
            Storage::disk('public')->delete($department->logo);
        }

        $department->delete();

        return redirect()->route('department.index');
    }
}
