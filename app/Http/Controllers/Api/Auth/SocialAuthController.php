<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kreait\Laravel\Firebase\Facades\Firebase;

class SocialAuthController extends Controller
{
    private $firebaseAuth;

    public function __construct()
    {
        $this->firebaseAuth = Firebase::auth();
    }

    public function loginWithGoogle(Request $request)
    {
        $userData = $request->input('user');

        $user = User::where('email', $userData['email'])->first();

        if (!$user) {
            $user = User::create([
                'nom' => $userData['displayName'],
                'email' => $userData['email'],
                'google_id' => $userData['uid'],
                'image' => $userData['photoURL'] ?? null,
                'password' => null,
            ]);
        }

        Auth::login($user);

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json(['token' => $token, 'user' => $user]);
    }
}
