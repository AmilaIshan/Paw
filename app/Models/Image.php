<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;


class Image extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'image_url',
        'product_id',
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
