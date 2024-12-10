<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use App\Models\Order;
use App\Models\OrderItem;
use Cart; // Cart facade ko import karein agar aapne Cart ka package use kiya hai.

class PaymentController extends Controller
{
    public function processOrder(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'address' => 'required|string',
            'stripeToken' => 'required', // Stripe token ki validation
        ]);

        // Set Stripe API key
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Create a charge
        try {
            $amount = Cart::total(); // Cart se total amount lein

            $charge = Charge::create([
                'amount' => $amount * 100, // Amount in cents
                'currency' => 'usd', // Currency
                'description' => 'Order Payment',
                'source' => $request->stripeToken, // From Stripe Element
                'metadata' => [
                    'name' => $request->name,
                    'email' => $request->email,
                    'address' => $request->address,
                ],
            ]);

            // Save order details in the database
            $order = new Order();
            $order->user_id = auth()->id(); // User ID save karein
            $order->total_amount = $amount; // Total amount save karein
            $order->address = $request->address; // User ka address
            $order->payment_status = 'completed'; // Payment status
            $order->save();

            // Cart items ko order_items table mein save karein
            foreach (Cart::content() as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->id,
                    'quantity' => $item->qty,
                    'price' => $item->price,
                ]);
            }

            // Cart ko empty karein
            Cart::destroy();

            return redirect()->route('payment.success')->with('success', 'Payment successful!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function success()
    {
        return view('payment.success', ['message' => 'Payment successful!']);
    }
}
