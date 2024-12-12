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

        
    }
}
