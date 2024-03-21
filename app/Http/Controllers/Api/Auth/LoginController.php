<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\DeliveryMan;
use App\Models\User;
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
                $user = Auth::user();

                if ($user->isArtisan()) {
                    $user->load('artisan');
                } elseif ($user->isDeliveryMan()) {
                    $user->load('deliveryMan');
                }

                return response()->json(['token' => $token, 'user' => $user]);
            }

            return response()->json(['error' => 'Invalid credentials'], 401);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function deliveryManLogin(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                if ($user->isDeliveryMan()) {
                    $token = $request->user()->createToken('api-token')->plainTextToken;
                    $user->load('deliveryMan');

                    return response()->json(['token' => $token, 'user' => $user]);
                }

                return response()->json(['error' => 'Invalid credentials'], 401);
            }
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
                $user = Auth::user();

                if ($user->isArtisan()) {
                    $user->load('artisan');
                } elseif ($user->isDeliveryMan()) {
                    $user->load('deliveryMan');
                }

                return response()->json(['user' => $user]);
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
                $token = $request->user()->token();
                if ($request->user()->token()->isExpired()) {
                    $request->user()->tokens()->delete();
                    $token = $request->user()->createToken('api-token')->plainTextToken;
                }

                return response()->json(['token' => $token]);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    // SET DELIVERYMAN EST_DISPONIBLE TO 0 OR 1
    public function setDeliveryManAvailability(Request $request)
    {
        try {

            $user = User::where('id', $request->input('user_id'))->first();

            DeliveryMan::where('user_id', $user->id)
                ->update(['est_disponible' => $request->input('est_disponible')]);

            return response()->json(['user' => $user->load('deliveryMan')]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
