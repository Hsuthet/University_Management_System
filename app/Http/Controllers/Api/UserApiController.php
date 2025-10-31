<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserApiController extends Controller{

    public function users()
    {
        $users = User::all();
        //return $users;
        return response()->json(
            [
                'message'=>'Here is user data',
                'user'=> $users,
            ]
            );
    }

     public function userDetails($id)
    {
        
        $user = User::findOrFail($id);
       return new UserResource($user);
    }

    public function userDelete($id)
    {
         $user = User::findOrFail($id);
         if($user){
            $user->delete();
         }
        return $user;
    }

    // Update user
    public function userUpdate(Request $request, $id)
{
    $user = User::findOrFail($id);

    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|unique:users,email,' . $user->id,
        'password' => 'nullable|string|min:6',
    ]);

    if (!empty($validatedData['password'])) {
        $validatedData['password'] = bcrypt($validatedData['password']);
    } else {
        unset($validatedData['password']);
    }

    $user->update($validatedData);
    $user->refresh(); 

    return response()->json([
        'message' => 'User updated successfully',
        'user' => $user,
    ]);
}

}