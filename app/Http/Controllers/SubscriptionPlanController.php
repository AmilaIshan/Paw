<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubscriptionPlan;
use App\Http\Resources\SubscriptionPlanResource;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class SubscriptionPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    


    public function index()
    {
        
        $plans = SubscriptionPlan::all();
        $userSubscriptions = [];
        
        if (Auth::check()) {
            // Get all subscription plan IDs that the user is subscribed to
            $userSubscriptions = Subscription::where('user_id', Auth::id())
                ->pluck('subscription_plan_id')
                ->toArray();
        }
        
        return response()->json([
            'data' => $plans->map(function ($plan) use ($userSubscriptions) {
                return [
                    'id' => $plan->id,
                    'authid' => auth()->id(),
                    'name' => $plan->name,
                    'price' => $plan->price,
                    'image_url' => $plan->image_url,
                    'is_subscribed' => in_array($plan->id, $userSubscriptions)
                ];
            })
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $plan = SubscriptionPlan::findOrFail($id);
        return new SubscriptionPlanResource($plan);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
