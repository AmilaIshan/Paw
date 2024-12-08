<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

class Transaction extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'product_id',
        'user_id',
        'quantity',
        'price',
        'created_date',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    // public function products(){
    //     return $this->belongsTo(Product::class);
    // }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
