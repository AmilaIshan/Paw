<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
