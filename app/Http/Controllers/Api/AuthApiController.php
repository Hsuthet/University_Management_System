<?php
 
namespace App\Http\Controllers\Api;
 
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
 
class AuthApiController extends Controller
{
 
    public function register(Request $request)
    {
        //return "This is register";
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required'
        ]);
 
        $user = User::create([
            'name' =>$request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
 
        $token = $user->createToken('myapptoken');
 
        return response()->json([
            'user'=>$user,
            'token'=>$token->plainTextToken
        ],201);
 
 
    }

   public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    $token = $user->createToken('myapptoken')->plainTextToken;

    return response()->json([
        'message' => 'Successful login',
        'token' => $token,
        'user' => $user
    ], 200);
}

    
        
        public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
 
        return response()->json([
                'message'=>'Successful Logout'
            ],201);
    }
}
 