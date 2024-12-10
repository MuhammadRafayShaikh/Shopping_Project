<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            $cartcount = Cart::where('user_id', Auth::id())->count();
            $wishcount = Wishlist::where('user_id', Auth::id())->count();
            // return $cartcount;
        } else {
            $cartcount = 0;
            $wishcount = 0;
        }
        $subcategory = Subcategory::where('s_i_header', 1)->select('id', 'sub_cat_name')->get();
        $subcategory2 = Subcategory::where('s_i_footer', 1)->select('id', 'sub_cat_name')->get();


        $carts = Cart::where('user_id', Auth::id())->get();
        return view('cart', compact('carts', 'cartcount', 'subcategory', 'subcategory2', 'wishcount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $id)
    {
        // if (Auth::check()) {
        //     return redirect()->route('singleProduct')->with('cart', 'Please Login First');
        // } else {
        $Productqty = Product::select('product_qty')->find($id);

        if ($Productqty->product_qty == 0) {
            return redirect('/')->with('outofstock', 'Product Out Of Stock');
        } else {


            $checkCart = Cart::where(['product_id' => $id, 'user_id' => Auth::id()])->get();
            // return $checkCart;
            // return $checkCart;
            if ($checkCart->count() > 0) {
                return redirect()->route('singleProduct', $id)->with('carterror', 'Product Already in Cart');
            } else {

                $cart = Cart::create([
                    'product_id' => $id,
                    'user_id' => Auth::id(),
                    'price' => $request->product_price
                ]);

                return redirect()->route('singleProduct', $id)->with('cart', 'Product Add to Cart Successfully');
            }
        }
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
        // Find the cart item by ID
        $cartItem = Cart::findOrFail($id); // Find the cart item

        $cartItem->quantity = $request->input('quantity'); // Update quantity
        $cartItem->price = $request->input('product_price') * $request->input('quantity'); // Update price

        $cartItem->save(); // Save the cart item with updated quantity and price

        return response()->json(['success' => true, 'message' => 'Cart updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // return $id;
        $cart = Cart::find($id);

        $cart->delete();
    }
}
