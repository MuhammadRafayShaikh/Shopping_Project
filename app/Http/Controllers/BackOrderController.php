<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Mail\welcomeemail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BackOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with(['orderItems.product', 'user'])->orderBy('created_at', 'desc')->paginate(4);
        perPage:

        // return $orders;
        return view('admin.orders', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $email = Order::with(relations: ['orderItems.product', 'user'])->orderBy('created_at', 'desc')->find($id);
        // return $email->user->email;
        $productNames = $email->orderItems->map(function ($orderItem) {
            return $orderItem->product->product_name; // Assuming 'name' is the column name in the products table
        });


        // return $orders->user->email;
        $order = Order::find($id);

        $order->update(['payment_status' => 'paid']);

        $subject = "Thanks For Shopping";

        Mail::to($email->user->email)->send(new welcomeemail($productNames, $subject));

        return redirect()->route('backorder.index')->with('order', 'Payment Status Updated Successfully');
    }

    public function update2(Request $request, string $id)
    {
        $order = Order::find($id);

        $order->update(['order_status' => 'delivered']);

        return redirect()->route('backorder.index')->with('order', 'Delievery Status Updated Successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
