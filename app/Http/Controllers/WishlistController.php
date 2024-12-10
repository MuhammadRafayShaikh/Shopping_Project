<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Wishlist;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            $wishcount = Wishlist::where('user_id', Auth::id())->count();
            $cartcount = Cart::where('user_id', Auth::id())->count();
            // return $cartcount;
        } else {
            $wishcount = 0;
            $cartcount = 0;
        }
        $subcategory = Subcategory::where('s_i_header', 1)->select('id', 'sub_cat_name')->get();
        $subcategory2 = Subcategory::where('s_i_footer', 1)->select('id', 'sub_cat_name')->get();

        $wishlist = Wishlist::with('product')->where('user_id', Auth::id())->get();
        return view('wishlist', compact('wishlist', 'wishcount', 'cartcount', 'subcategory', 'subcategory2'));
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
        $checkCart = Wishlist::where(['product_id' => $id, 'user_id' => Auth::id()])->get();
        // return $checkCart;
        // return $checkCart;
        if ($checkCart->count() > 0) {
            return redirect()->route('singleProduct', $id)->with('carterror', 'Product Already in Wishlist');
        } else {

            $cart = Wishlist::create([
                'product_id' => $id,
                'user_id' => Auth::id()
            ]);

            return redirect()->route('singleProduct', $id)->with('cart', 'Product Add to Wishlist Successfully');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cart = Wishlist::find($id);

        $cart->delete();
    }
}
