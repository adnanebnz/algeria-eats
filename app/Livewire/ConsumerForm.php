<?php

namespace App\Livewire;

use AnouarTouati\AlgerianCitiesLaravel\Facades\AlgerianCitiesFacade;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use RealRashid\SweetAlert\Facades\Alert;

class ConsumerForm extends Component
{
    use WithFileUploads;

    public $nom;

    public $prenom;

    public $image;

    public $num_telephone;

    public $adresse;

    public $wilaya;

    public $email;

    public $password;

    public $password_confirmation;

    protected $rules = [
        'nom' => 'required|string',
        'prenom' => 'required|string',
        'num_telephone' => 'required|string|unique:users|regex:/^0[567]\d{8}$/',
        'adresse' => 'required|string',
        'wilaya' => 'required|string',
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
            $user = User::create($validatedData);

            if ($this->image) {
                $imagePath = $this->image->store('profile_images', 'public');
                $user->update(['image' => $imagePath]);
            }

            $user->consumer()->create([]);
            auth()->login($user);
            Alert::success('Succès', 'Votre compte a été créé avec succès');

            return redirect()->to('/');
        });
    }

    public function render()
    {
        $wilayas = AlgerianCitiesFacade::getAllWilayas();

        return view('livewire.consumer-form', compact('wilayas'));
    }
}
