<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\View;
use App\Models\Brand;
use App\Models\Review;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\OrderItem;

use App\Models\Subcategory;
use function Termwind\style;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class FrontController extends Controller
{

    public function products()
    {
        if (Auth::check()) {
            $cartcount = Cart::where('user_id', Auth::id())->count();
            $wishcount = Wishlist::where('user_id', Auth::id())->count();
            // return $cartcount;
        } else {
            $cartcount = 0;
            $wishcount = 0;
        }
        // return $subcategory;
        $products = Product::limit(5)->get();
        // return $products;
        $latestproducts = Product::orderBy('id', 'DESC')->limit(5)->get();
        $subcategory = Subcategory::where('s_i_header', 1)->select('id', 'sub_cat_name')->get();
        $subcategory2 = Subcategory::where('s_i_footer', 1)->select('id', 'sub_cat_name')->get();


        return view('index', compact('products', 'latestproducts', 'subcategory', 'cartcount', 'subcategory2', 'wishcount'));
    }

    public function allProducts()
    {
        if (Auth::check()) {
            $cartcount = Cart::where('user_id', Auth::id())->count();
            $wishcount = Wishlist::where('user_id', Auth::id())->count();
            // return $cartcount;
        } else {
            $cartcount = 0;
            $wishcount = 0;
        }
        // return $subcategory;
        $products = Product::orderBy('id', 'DESC')->paginate(2);
        // return $products;
        $subcategory = Subcategory::where('s_i_header', 1)->select('id', 'sub_cat_name')->get();
        $subcategory2 = Subcategory::where('s_i_footer', 1)->select('id', 'sub_cat_name')->get();


        return view('all_products', compact('products', 'subcategory', 'cartcount', 'subcategory2', 'wishcount'));
    }

    public function latestProducts()
    {
        if (Auth::check()) {
            $cartcount = Cart::where('user_id', Auth::id())->count();
            $wishcount = Wishlist::where('user_id', Auth::id())->count();
            // return $cartcount;
        } else {
            $cartcount = 0;
            $wishcount = 0;
        }
        // return $subcategory;
        $products = Product::orderBy('id', 'DESC')->paginate(2);
        // return $products;
        $subcategory = Subcategory::where('s_i_header', 1)->select('id', 'sub_cat_name')->get();
        $subcategory2 = Subcategory::where('s_i_footer', 1)->select('id', 'sub_cat_name')->get();


        return view('latest_products', compact('products', 'subcategory', 'cartcount', 'subcategory2', 'wishcount'));
    }


    public function singleProduct(Request $request, string $id)
    {
        $deleteReview = Review::where(['product_id' => $id, 'user_id' => Auth::id()])->count();
        // return $deleteReview;

        $order = OrderItem::with('order')->orderBy('id', 'DESC')->withWhereHas('order', function ($sql) {
            $sql->where('user_id', Auth::id());
        })->where(['product_id' => $id])->count();

        $product = Product::find($id);

        $sessionKey = 'product' . $id;
        if (Auth::check()) {

            $viewConfirm = View::where(['product_id' => $id, 'user_id' => Auth::id()])->count();

            if ($viewConfirm === 0) {
                View::create([
                    'product_id' => $id,
                    'user_id' => Auth::id()
                ]);

                $product = Product::find($id);
                if ($product) {
                    $product->increment('product_views');
                }
            }


            $cartcount = Cart::where('user_id', Auth::id())->count();
            $wishcount = Wishlist::where('user_id', Auth::id())->count();
        } else if (!$request->session()->has($sessionKey)) {
            $product->increment('product_views');

            $request->session()->put($sessionKey, true);

            $cartcount = 0;
            $wishcount = 0;
        } else {
            $cartcount = 0;
            $wishcount = 0;
        }

        $reviews = Review::with('product', 'user')->where('product_id', $id)->orderBy('id', 'DESC')->limit(4)->get();

        $product = Product::with('subcategory')->find($id);
        $subcategory = Subcategory::where('s_i_header', 1)->select('id', 'sub_cat_name')->get();
        $subcategory2 = Subcategory::where('s_i_footer', 1)->select('id', 'sub_cat_name')->get();

        return view('single_product', compact('product', 'subcategory', 'cartcount', 'subcategory2', 'wishcount', 'order', 'reviews', 'deleteReview'));
    }


    public function liveSearch(Request $request)
    {
        $search = $request->input('search');

        if ($search != '') {
            $products = Product::where('product_name', 'LIKE', "%{$search}%")->get();
        } else {
            $products = Product::limit(5)->get();
        }


        $output = '';

        if (count($products) > 0) {
            $output .= '<div style="display: flex;">';
            foreach ($products as $product) {
                $output .= '
            <div class="product-grid latest  item" style="width: 100%; max-width: 250px; margin: 10px;">
                <div class="product-image popular">
                    <a class="image" href="">
                        <img style="width: 100%; height: auto;" class="pic-1" src="' . asset('uploads/' . $product->product_image) . '">
                    </a>
                    <div class="product-button-group">
                        <a href="' . route('singleProduct', $product->id) . '"><i class="fa fa-eye"></i></a>
                        <a href="" class="add-to-cart" data-id=""><i class="fa fa-shopping-cart"></i></a>
                        <a href="" class="add-to-wishlist" data-id=""><i class="fa fa-heart"></i></a>
                    </div>
                </div>
                <div class="product-content">
                    <h3 class="title">
                        <a href="">' . $product->product_name . '</a>
                    </h3>
                    <div class="price">' . $product->product_price . '</div>
                </div>
            </div>';
            }
            $output .= '</div>';
        } else {
            $output = '<div><h3>No products found   </h3></div>';  // Agar koi product nahi milta
        }

        return response()->json($output);
    }



    public function category(string $id)
    {
        if (Auth::check()) {
            $cartcount = Cart::where('user_id', Auth::id())->count();
            $wishcount = Wishlist::where('user_id', Auth::id())->count();
            // return $cartcount;
        } else {
            $cartcount = 0;
            $wishcount = 0;
        }

        $products = Product::with('subcategory')->where('product_sub_cat', $id)->paginate(1);
        // return $products;
        $subcategory = Subcategory::where('s_i_header', 1)->select('id', 'sub_cat_name')->get();
        $subcategoryname = Subcategory::select('sub_cat_name')->find($id);
        // return $subcategoryname;
        // return $products;
        $brands = Brand::with('category')->where('brand_cat', $id)->get();
        $subcategory2 = Subcategory::where('s_i_footer', 1)->select('id', 'sub_cat_name')->get();

        // return $brands;
        // $brands = Product::with('brand')->get();
        // return $brands;
        return view('category', compact('products', 'subcategory', 'subcategoryname', 'brands', 'cartcount', 'subcategory2', 'wishcount'));
    }

    public function brand(string $id)
    {
        if (Auth::check()) {
            $cartcount = Cart::where('user_id', Auth::id())->count();
            $wishcount = Wishlist::where('user_id', Auth::id())->count();
            // return $cartcount;
        } else {
            $cartcount = 0;
            $wishcount = 0;
        }

        $products = Product::with('brand')->where('product_brand', $id)->paginate(1);
        // return $products;
        $subcategory = Subcategory::where('s_i_header', 1)->select('id', 'sub_cat_name')->get();
        $subcategoryname = Brand::select('brand')->find($id);
        // return $subcategoryname;
        // return $products;
        $subcategories = Subcategory::with('brand')->where('id', $id)->get();
        $subcategory2 = Subcategory::where('s_i_footer', 1)->select('id', 'sub_cat_name')->get();

        // return $brands;
        // $brands = Product::with('brand')->get();
        // return $brands;
        return view('brands', compact('products', 'subcategory', 'subcategoryname', 'subcategories', 'cartcount', 'subcategory2', 'wishcount'));
    }

    public function singleuserview()
    {
        if (Auth::check()) {
            $cartcount = Cart::where('user_id', Auth::id())->count();
            $wishcount = Wishlist::where('user_id', Auth::id())->count();
        } else {
            $cartcount = 0;
            $wishcount = 0;
        }
        $subcategory = Subcategory::where('s_i_header', 1)->select('id', 'sub_cat_name')->get();
        $subcategory2 = Subcategory::where('s_i_footer', 1)->select('id', 'sub_cat_name')->get();

        return view('user_profile', compact('cartcount', 'wishcount', 'subcategory', 'subcategory2'));
    }
    public function singleUser()
    {
        $user = User::find(Auth::id());

        return response()->json($user);
    }
}
