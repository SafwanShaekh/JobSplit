<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use App\Mail\SubscriptionConfirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class SubscriptionController extends Controller
{
    public function store(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:subscribers,email'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('error', 'Subscription failed. Please try again.');
        }

        // Email ko database mein save karein
        $subscriber = Subscriber::create([
            'email' => $request->email
        ]);

        // Email bhejein
        Mail::to($subscriber->email)->send(new SubscriptionConfirmation());

        // Kamyabi ka message bhejein
        return back()->with('success', 'Thank you for subscribing!');
    }
}