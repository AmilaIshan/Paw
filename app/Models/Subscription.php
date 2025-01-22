<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'user_id',
        'plan_id',
        'start_date',
        'end_date',
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
