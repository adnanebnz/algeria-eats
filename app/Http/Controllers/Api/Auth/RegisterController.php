<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Artisan;
use App\Models\Consumer;
use App\Models\DeliveryMan;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function registerConsymer(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:3|confirmed',
            'password_confirmation' => 'required|min:3|same:password',
            'adresse' => 'required|string',
            'num_telephone' => 'required',
            'wilaya' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);
        $user = User::create($data);
        Consumer::create([
            'user_id' => $user->id,
        ]);

        return response()->json(['message' => 'User created successfully'], 201);
    }

    public function registerDeliveryMan(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:3|confirmed',
            'password_confirmation' => 'required|min:3|same:password',
            'adresse' => 'required|string',
            'num_telephone' => 'required',
            'wilaya' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'est_disponible' => 'required',
        ]);
        $user = User::create([
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'email' => $data['email'],
            'password' => $data['password'],
            'adresse' => $data['adresse'],
            'num_telephone' => $data['num_telephone'],
            'wilaya' => $data['wilaya'],
            'image' => $data['image'],
        ]);

        DeliveryMan::create([
            'user_id' => $user->id,
            'est_disponible' => $data['est_disponible'],
        ]);

        return response()->json(['message' => 'User created successfully'], 201);
    }

    public function registerArtisan(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:3|confirmed',
            'password_confirmation' => 'required|min:3|same:password',
            'adresse' => 'required|string',
            'num_telephone' => 'required',
            'wilaya' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'desc_entreprise' => 'required',
            'heure_ouverture' => 'required',
            'heure_fermeture' => 'required',
            'type_service' => 'required',
        ]);

        $user = User::create([
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'email' => $data['email'],
            'password' => $data['password'],
            'adresse' => $data['adresse'],
            'num_telephone' => $data['num_telephone'],
            'wilaya' => $data['wilaya'],
            'image' => $data['image'],
        ]);

        Artisan::create([
            'user_id' => $user->id,
            'desc_entreprise' => $data['desc_entreprise'],
            'heure_ouverture' => $data['heure_ouverture'],
            'heure_fermeture' => $data['heure_fermeture'],
            'type_service' => $data['type_service'],
        ]);

        return response()->json(['message' => 'User created successfully'], 201);
    }
}
