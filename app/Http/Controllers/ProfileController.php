<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    // Show user profile
    public function show()
    {
        // Get the logged-in user
        $user = auth()->user();

        return view('profile', compact('user'));
    }

    // Show edit form
    public function edit($id)
    {
        $user = auth()->user();

        // Prevent editing someone else’s profile
        if ($user->id != $id) {
            abort(403, 'Unauthorized action.');
        }

        return view('profile.edit', compact('user'));
    }

    // Handle profile update
  public function update(Request $request, $id)
{
    $user = auth()->user();

    if ($user->id != $id) {
        abort(403, 'Unauthorized action.');
    }

    $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'role' => 'nullable|string',
        'department_id' => 'nullable|integer',
        'academic_year_id' => 'nullable|integer',
        'phone_number' => 'nullable|string',
        'age' => 'nullable|integer',
        'address' => 'nullable|string',
        'roll_number' => 'nullable|string',
        'father_name' => 'nullable|string',
        'gender' => 'nullable|string',
        'nrc' => 'nullable|string',
        'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    //  Handle image upload
    if ($request->hasFile('profile_image')) {
        $file = $request->file('profile_image');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('profile_images', $filename, 'public');
        $data['profile_image'] = $path; // e.g. "profile_images/12345_john.jpg"
    }

    // Update record
    \App\Models\User::where('id', $user->id)->update($data);

    return redirect()->route('profiles.show')->with('success', 'Profile updated successfully!');
}

}
