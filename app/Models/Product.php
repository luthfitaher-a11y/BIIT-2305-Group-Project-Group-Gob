<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'price', 'old_price',
        'stock', 'image', 'badge', 'sport',
        'category_id', 'brand_id'
    ];

    // A product belongs to a category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // A product belongs to a brand
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    // A product has many reviews
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Helper: calculate average star rating
    public function averageRating(): float
    {
        return round($this->reviews()->avg('rating') ?? $this->rating, 1);
    }
}