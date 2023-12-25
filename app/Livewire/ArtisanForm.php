<?php

namespace App\Livewire;

use AnouarTouati\AlgerianCitiesLaravel\Facades\AlgerianCitiesFacade;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use RealRashid\SweetAlert\Facades\Alert;

class ArtisanForm extends Component
{
    use WithFileUploads;

    public $nom;

    public $image;

    public $prenom;

    public $num_telephone;

    public $adresse;

    public $wilaya;

    public $email;

    public $password;

    public $password_confirmation;

    public $type_service;

    public $desc_entreprise;

    public $heure_ouverture;

    public $heure_fermeture;

    protected $rules = [
        'nom' => 'required|string',
        'prenom' => 'required|string',
        'num_telephone' => 'required|string|unique:users|regex:/^0[567]\d{8}$/',
        'adresse' => 'required|string',
        'wilaya' => 'required|string',
        'desc_entreprise' => 'required|string',
        'heure_ouverture' => 'required|string',
        'heure_fermeture' => 'required|string',
        'type_service' => 'required|in:sucree,salee,sucree_salee',
        'email' => 'required|email|unique:users',
        'image' => 'nullable|image|max:4096',
        'password' => 'required|min:3|confirmed',
        'password_confirmation' => 'required|same:password',
    ];

    protected $messages = [
        'num_telephone.regex' => 'Le numéro de téléphone doit être un numéro de téléphone mobile algérien valide',
    ];

    public function submit()
    {
        $validatedData = $this->validate();
        $validatedData['password'] = bcrypt($validatedData['password']);

        return DB::transaction(function () use ($validatedData) {
            $user = User::create([
                'nom' => $validatedData['nom'],
                'prenom' => $validatedData['prenom'],
                'num_telephone' => $validatedData['num_telephone'],
                'adresse' => $validatedData['adresse'],
                'wilaya' => $validatedData['wilaya'],
                'email' => $validatedData['email'],
                'image' => $validatedData['image'],
                'password' => $validatedData['password'],
            ]);

            if ($this->image) {
                $imagePath = $this->image->store('profile_images', 'public');
                $user->update(['image' => $imagePath]);
            }

            $user->artisan()->create([
                'type_service' => $validatedData['type_service'],
                'desc_entreprise' => $validatedData['desc_entreprise'],
                'heure_ouverture' => $validatedData['heure_ouverture'],
                'heure_fermeture' => $validatedData['heure_fermeture'],
            ]);

            auth()->login($user);
            Alert::success('Succès', 'Votre compte a été créé avec succès');

            return redirect()->to('/');
        });
    }

    public function render()
    {
        $wilayas = AlgerianCitiesFacade::getAllWilayas();

        return view('livewire.artisan-form', compact('wilayas'));
    }
}
