<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //  public function show()
    // {
    //     $user = Profile::getDummyProfile();
    //     return view('index', compact('user'));
    // }

//     public function show()
// {
//     $user = Profile::getDummyProfile();
//     return view('profile', compact('user'));
// }

  // Show edit form
  public function edit($id)
{
    $user = Profile::getDummyProfile();
    $user['id'] = $id; // for route parameter

    // Use dot notation to reference the folder
    return view('profile.edit', compact('user'));
}


    // Handle update
   public function show()
{
    // Check if updated data exists in session
    $user = session('user_profile', Profile::getDummyProfile());
    return view('profile', compact('user'));
}

public function update(Request $request, $id)
{
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'role' => 'nullable|string',
        'department' => 'nullable|string',
        'academic_year' => 'nullable|string',
        'phone' => 'nullable|string',
        'age' => 'nullable|integer',
        'father_name' => 'nullable|string',
        'gender' => 'nullable|string',
        'nrc' => 'nullable|string',
    ]);

    // Store updated data in session
    session(['user_profile' => $data]);

    return redirect()->route('profiles.show')->with('success', 'Profile updated successfully!');
}


}
