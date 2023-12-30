<?php

namespace App\Livewire;

use AnouarTouati\AlgerianCitiesLaravel\Facades\AlgerianCitiesFacade;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use RealRashid\SweetAlert\Facades\Alert;

class DeliveryManForm extends Component
{
    use WithFileUploads;

    public $nom;

    public $image;

    public $prenom;

    public $num_telephone;

    public $adresse;

    public $wilaya;

    public $email;

    public $est_disponible;

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
        'est_disponible' => 'required|integer|in:1,0',
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
                $filename =
                    'image_'.
                    uniqid().
                    '.'.
                    $this->image->getClientOriginalExtension();
                Storage::disk('public')->put(
                    $filename,
                    file_get_contents($this->image->getRealPath())
                );
                $uploadedFileUrl = Storage::disk('public')->url($filename);
                $user->update(['image' => $uploadedFileUrl]);
            }

            $user->deliveryMan()->create([
                'est_disponible' => $validatedData['est_disponible'],
            ]);

            auth()->login($user);
            Alert::success('Succès', 'Votre compte a été créé avec succès');

            return redirect()->to('/');
        });
    }

    public function render()
    {
        $wilayas = AlgerianCitiesFacade::getAllWilayas();

        return view('livewire.delivery-man-form', compact('wilayas'));
    }
}
