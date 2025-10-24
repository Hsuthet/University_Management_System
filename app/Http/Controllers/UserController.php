<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');

    $users = User::with(['department', 'academicYear'])
        ->when($search, function($query, $search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('role', 'like', "%{$search}%")
                  ->orWhere('phone_number', 'like', "%{$search}%")
                  ->orWhere('nrc', 'like', "%{$search}%");
        })
        ->paginate(10);

    return view('user.index', compact('users'));
}


    public function create() {
        $departments = Department::all();
        $academicYears = AcademicYear::all();
        return view('user.create', compact('departments','academicYears'));
    }

    public function store(Request $request) {
        $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users,email',
            'role'=>'nullable|string',
            'department_id'=>'nullable|exists:departments,id',
            'phone_number'=>'nullable|string|max:20',
            'academic_year_id'=>'nullable|exists:academic_years,id',
            'age'=>'nullable|integer',
            'address'=>'nullable|string',
            'roll_number'=>'nullable|string',
            'father_name'=>'nullable|string',
            'password'=>'required|string|min:6|confirmed',
            'gender'=>'nullable|in:male,female,other',
            'nrc'=>'nullable|string',
            'profile_image'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $data = $request->except('password','profile_image');
        $data['password'] = Hash::make($request->password);

        if($request->hasFile('profile_image')){
            $data['profile_image'] = $request->file('profile_image')->store('users','public');
        }

        User::create($data);

        return redirect()->route('user.index');
    }

    public function edit($id) {
        $user = User::findOrFail($id);
        $departments = Department::all();
        $academicYears = AcademicYear::all();
        return view('user.edit', compact('user','departments','academicYears'));
    }

  public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'role' => 'nullable|string',
        'department_id' => 'nullable|exists:departments,id',
        'phone_number' => 'nullable|string|max:20',
        'academic_year_id' => 'nullable|exists:academic_years,id',
        'age' => 'nullable|integer',
        'address' => 'nullable|string',
        'roll_number' => 'nullable|string',
        'father_name' => 'nullable|string',
        'password' => 'nullable|string|min:6', 
        'gender' => 'nullable|in:male,female,other',
        'nrc' => 'nullable|string',
        'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ]);

    $data = $request->except('password', 'profile_image');

    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }

    if ($request->hasFile('profile_image')) {
        if ($user->profile_image) {
            Storage::disk('public')->delete($user->profile_image);
        }
        $data['profile_image'] = $request->file('profile_image')->store('users', 'public');
    }

    $user->update($data);

    return redirect()->route('user.index')->with('success', 'User updated successfully.');
}


    public function destroy($id){
        $user = User::findOrFail($id);
        if($user->profile_image){
            Storage::disk('public')->delete($user->profile_image);
        }
        $user->delete();
        return redirect()->route('user.index');
    }

    public function show(User $user)
{
    // Fetch the user and optionally their blogs
    $blogs = $user->blogs()->latest()->get();

    return view('user.profile', compact('user', 'blogs'));
}

}
