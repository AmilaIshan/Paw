<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

class Category extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'category_name',
    ];

    public function products(){
        return $this->hasMany(Product::class);
    }
}
