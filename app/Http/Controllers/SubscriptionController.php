<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\Website;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Website $website)
    {
        // Check if user is already subscribed to this website
        if(Subscription::where('user_id', auth()->id())->where('website_id', $website->id)->exists()) {
            return response()->json([
                'message' => 'You are already subscribed to this website'
            ], 400);
        }

        // Create subscription
        Subscription::create([
            'user_id' => auth()->id(),
            'website_id' => $website->id
        ]);

        return response()->json([
            'message' => 'Subscription created successfully'
        ], 200);
    }
}
