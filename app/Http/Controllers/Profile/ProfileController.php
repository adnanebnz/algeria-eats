<?php

namespace App\Http\Controllers\Profile;

use AnouarTouati\AlgerianCitiesLaravel\Facades\AlgerianCitiesFacade;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
        $this->middleware('checkProfileOwnership')->only(['update', 'destroy']);
    }

    public function index(User $user)
    {
        $wilayas = AlgerianCitiesFacade::getAllWilayas();
        if ($user->isArtisan()) {
            $artisanProducts = Product::where('artisan_id', $user->id)->get();
            $similarArtisans = User::where('id', '!=', $user->id)
                ->where('wilaya', $user->wilaya)
                ->whereHas('artisan', function ($query) use ($user) {
                    $query->where('type_service', $user->artisan->type_service);
                })
                ->take(6)->get();
        }

        if ($user->isDeliveryMan()) {
            $similarDeliveryMen = User::where('id', '!=', $user->id)
                ->where('wilaya', $user->wilaya)
                ->whereHas('deliveryMan', function ($query) use ($user) {
                    $query->where('est_disponible', $user->deliveryMan->est_disponible);
                })
                ->take(6)->get();
        }

        return view(
            'auth.profile',
            [
                'user' => $user, 'wilayas' => $wilayas, 'artisanProducts' => $artisanProducts ?? null,
                'similarArtisans' => $similarArtisans ?? null,
                'similarDeliveryMen' => $similarDeliveryMen ?? null,
            ]
        );
    }

    public function update(User $user, Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'num_telephone' => 'required|string',
            'adresse' => 'required|string|max:255',
            'wilaya' => 'required|string|max:255',
            'password' => 'nullable|string',
        ]);

        $user->update([
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'email' => $data['email'],
            'num_telephone' => $data['num_telephone'],
            'adresse' => $data['adresse'],
            'wilaya' => $data['wilaya'],
        ]);

        // Update artisan-specific fields
        if ($user->artisan) {
            $speceficData = $request->validate([
                'heure_ouverture' => 'required|string',
                'heure_fermeture' => 'required|string',
                'desc_entreprise' => 'required|string',
                'type_service' => 'required|string',
            ]);

            $user->artisan->update($speceficData);
        }

        // Update deliveryman-specific fields
        if ($user->deliveryMan) {
            $speceficData = $request->validate([
                'est_disponible' => 'required|integer|in:1,0',
            ]);

            $user->deliveryMan->update($speceficData);
        }

        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($request->input('password'))]);
        }

        if ($request->hasFile('image')) {
            if ($user->image) {
                // THE IMAGE IS IN public disk in profile_images folder
                Storage::disk('public')->delete($user->image);
            }
            $image = $request->file('image');
            $imagePath = $image->store('profile_images', 'public');
            $user->update(['image' => $imagePath]);
        }

        Alert::success('Profil mis à jour !', 'Votre profil a été mis à jour avec succès !');

        return redirect()->route('profile', ['user' => $user]);
    }

    public function destroy(User $user)
    {
        $user->delete();
        Alert::success('Compte supprimé !', 'Votre compte a été supprimé avec succès !');

        return redirect()->route('index');
    }
}
