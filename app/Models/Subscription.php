<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

class Subscription extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'user_id',
        'plan_id',
    ];

    protected $casts = [
        'image_url' => 'array'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function plan(){
        return $this->belongsTo(SubscriptionPlan::class);
    }
}
