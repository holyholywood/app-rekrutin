<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Response\ResponseTraits;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ResponseTraits;

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);
        if (!$token) {
            return $this->sendError(401, 'Unauthorized');
        }

        $user = Auth::user();
        $payload = [
            'user' => $user,
            'authorization' => [
                'token' => $token,
                'type' => 'bearer'
            ],
        ];

        return $this->sendResponse($payload, 200);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'birth_date' => $request->birth_date,
            'address' => $request->address,
            'phone' => $request->phone,
            'education_level' => $request->education_level,
            'majors' => $request->majors,
        ]);

        $token = Auth::login($user);
        $payload = [
            'user' => $user,
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ];

        return $this->sendResponse($payload);
    }

    public function logout()
    {
        Auth::logout();

        return $this->sendResponse('Logout Succesful', 200, 'Logout Succesful');
    }

    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }
}
