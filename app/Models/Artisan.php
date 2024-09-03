<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Artisan extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'user_id',
        'desc_entreprise',
        'heure_ouverture',
        'heure_fermeture',
        'rating',
        'type_service',
    ];

    protected $primaryKey = 'user_id';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'artisan_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'artisan_id');
    }

    public function reviews()
    {
        return $this->hasMany(UserReview::class, 'user_id');
    }

    public function getFullName(): string
    {
        return $this->user->nom.' '.$this->user->prenom;
    }

    public function scopeFilters(Builder $query, array $filters): void
    {
        $query->when($filters['artisanRating'] ?? null, function (
            Builder $query,
            $artisanRating
        ) {
            $query->where('rating', '>=', $artisanRating);
        });

        $query->when($filters['artisanWilaya'] ?? null, function (
            Builder $query,
            $artisanWilaya
        ) {
            $query->whereHas('user', function (Builder $query) use (
                $artisanWilaya
            ) {
                $query->where('wilaya', $artisanWilaya);
            });
        });

        $query->when($filters['search'] ?? null, function (
            Builder $query,
            $search
        ) {
            $query->where(function (Builder $query) use ($search) {
                $query->whereHas('user', function (Builder $query) use (
                    $search
                ) {
                    $query->where(function (Builder $query) use ($search) {
                        $query
                            ->where('nom', 'LIKE', '%'.$search.'%')
                            ->orWhere('prenom', 'LIKE', '%'.$search.'%')
                            ->orWhereRaw(
                                "CONCAT(nom, ' ', prenom) LIKE ?",
                                '%'.$search.'%'
                            )
                            ->orWhere('email', 'LIKE', '%'.$search.'%');
                    });
                })
                    ->orWhere('desc_entreprise', 'LIKE', '%'.$search.'%')
                    ->orWhere('type_service', 'LIKE', '%'.$search.'%');
            });
        });

        $query->when($filters['typeService'] ?? null, function (
            Builder $query,
            $type_service
        ) {
            $query->where('type_service', $type_service);
        });
    }
}
