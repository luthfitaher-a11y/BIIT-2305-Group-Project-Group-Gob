<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'password', 'phone', 'address'];
    protected $hidden   = ['password', 'remember_token'];

    // A user has one active cart
    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    // A user has many orders
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // A user has many reviews
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}