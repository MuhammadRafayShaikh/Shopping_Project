<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\PaymentIntent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function payment(string $amount)
    {
        $cart = Cart::where('user_id', Auth::id());

        return view('stripe', compact('amount'));
    }

    public function createPayment(Request $request)
    {

        Stripe::setApiKey('sk_test_51QC2ODIe4idSW70tDuPsYTghj5mmmTHUbF9PktegF6aT3EkievLJ3NsscCWp6xScUAxAxjGBTsJIw68AGuytkWQj00gzHHR6BL');

        try {
            // Create a customer with name and email
            $customer = Customer::create([
                'name' => Auth::user()->name, // Static for now, can be dynamic
                'email' => Auth::user()->email, // Static for now, can be dynamic
            ]);

            // Create PaymentIntent and attach the customer
            $paymentIntent = PaymentIntent::create([
                'amount' => $request->amount * 100, // Stripe accepts amount in cents
                'currency' => 'usd',
                'payment_method' => $request->stripeToken,
                'customer' => $customer->id, // Attach Customer ID
                'confirmation_method' => 'manual',
            ]);

            return response()->json([
                'success' => true,
                'paymentIntent' => $paymentIntent,
                'clientSecret' => $paymentIntent->client_secret,
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}
