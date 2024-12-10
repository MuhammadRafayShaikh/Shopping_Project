<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\OrderItem;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function show()
    {
        $orders = Order::with(['orderItems.product', 'user'])->where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        if (Auth::check()) {
            $cartcount = Cart::where('user_id', Auth::id())->count();
            $wishcount = Wishlist::where('user_id', Auth::id())->count();
        } else {
            $cartcount = 0;
            $wishcount = 0;
        }
        $subcategory = Subcategory::where('s_i_header', 1)->select('id', 'sub_cat_name')->get();
        $subcategory2 = Subcategory::where('s_i_footer', 1)->select('id', 'sub_cat_name')->get();

        // return $orders;

        // return $orders;
        return view('user_orders', compact('orders', 'cartcount', 'wishcount', 'subcategory', 'subcategory2'));
    }
    public function placeOrder(Request $request)
    {
        // $cart = Cart::where('user_id', Auth::id())->get();

        // $cart = Cart::where('user_id', Auth::id());

        // $cart->get();

        // // $cart->delete();

        // $total_amount = $cart->sum('price');

        // return $total_amount;

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'address' => 'required|string',
        ]);

        $cartItems = Cart::where('user_id', Auth::id())->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty!');
        }

        $totalPrice = $cartItems->sum(function ($item) {
            return $item->quantity * $item->price;
        });

        $order = new Order();
        $order->user_id = Auth::id();
        $order->address = $request->address;
        $order->total_price = $totalPrice;
        $order->payment_status = 'pending';
        $order->save();

        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->price,
            ]);
            $productsqty = Product::where('id', $cartItem->product_id);
            $productsqty->decrement('product_qty', $cartItem->quantity);
        }

        $cart = Cart::where('user_id', Auth::id());

        $cart->get();

        $total_amount = $cart->sum('price');

        $cart->delete();

        return redirect()->route('payment', $total_amount)->with('total', $total_amount);
        // return view('stripe',compact('total_amount'));
    }

    public function success()
    {
        return view('order.success');
    }
}
