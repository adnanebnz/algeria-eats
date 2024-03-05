<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only('logout', 'me', 'refresh');
        $this->middleware('guest')->except('logout', 'me', 'refresh');
        $this->middleware('throttle:5,1')->only('login');
    }

    public function login(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                $token = $request->user()->createToken('api-token')->plainTextToken;

                return response()->json(['token' => $token, 'user' => $request->user()]);
            }

            return response()->json(['error' => 'Invalid credentials'], 401);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->tokens()->delete();

            return response()->json(['message' => 'Logged out']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function me(Request $request)
    {
        try {
            if (! $request->user()) {
                return response()->json(['error' => 'Unauthenticated'], 401);
            } else {
                return response()->json(['user' => $request->user()]);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function refresh(Request $request)
    {
        try {
            if (! $request->user()) {
                return response()->json(['error' => 'Unauthenticated'], 401);

            } else {
                $token = $request->user()->createToken('api-token')->plainTextToken;

                return response()->json(['token' => $token]);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
