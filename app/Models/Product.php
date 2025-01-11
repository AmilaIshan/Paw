<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

class Product extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'product_name',
        'description',
        'price',
        'quantity',
        'weight',
        'category_id',
        'admin_id',
        'image_url',
    ];

    protected $casts = [
        'image_url' => 'array'
    ];

    public function admin(){
        return $this->belongsTo(Admin::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function images(){
        return $this->hasMany(Image::class);
    }

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }

    public function cart(){
        return $this->hasMany(Cart::class);
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }
}
