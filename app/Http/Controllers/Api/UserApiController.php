<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
        return $user;
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
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
        ]);

        if (isset($validatedData['password'])) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        }

        $user->update($validatedData);

        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user,
        ]);
    }
}