<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    // Calculate the total price of all items in the cart
    public function total(): int
    {
        return $this->items()->get()->sum(fn ($item) => $item->price * $item->quantity);
    }

    // Calculate shipping cost: free over RM500
    public function shippingCost(): int
    {
        return $this->total() >= 500 ? 0 : 15;
    }
}