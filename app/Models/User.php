<?php

namespace App\Models;

use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements CanResetPasswordContract
{
    use CanResetPassword, HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'prenom',
        'adresse',
        'wilaya',
        'num_telephone',
        'email',
        'image',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password', 'remember_token'];

    protected $primaryKey = 'id';

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function deviceKeys()
    {
        return $this->hasMany(DeviceKey::class, 'user_id');
    }

    public function consumer()
    {
        return $this->hasOne(Consumer::class);
    }

    public function deliveryMan()
    {
        return $this->hasOne(DeliveryMan::class);
    }

    public function artisan()
    {
        return $this->hasOne(Artisan::class);
    }

    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'buyer_id');
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getFullName(): string
    {
        return $this->nom.' '.$this->prenom;
    }

    public function isArtisan(): bool
    {
        return $this->artisan !== null;
    }

    public function isDeliveryMan(): bool
    {
        return $this->deliveryMan !== null;
    }

    public function isAdmin(): bool
    {
        return $this->admin !== null;
    }

    public function isConsumer(): bool
    {
        return $this->consumer !== null;
    }
}
