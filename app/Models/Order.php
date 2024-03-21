<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'buyer_id',
        'artisan_id',
        'status',
        'adresse',
        'wilaya',
        'daira',
        'commune',
    ];

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function artisan()
    {
        return $this->belongsTo(Artisan::class, 'artisan_id');
    }

    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getTotalPrice()
    {
        $total = 0;
        foreach ($this->orderItems as $orderItem) {
            $total += $orderItem->product->prix * $orderItem->quantity;
        }

        return $total;
    }
}
