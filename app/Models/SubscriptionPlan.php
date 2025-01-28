<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

class SubscriptionPlan extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'name',
        'price',
        'duration',
        'description',
        'image_url',
    ];

    public function subscriptions(){
        return $this->hasMany(Subscription::class);
    }
}
