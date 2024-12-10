<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\Review;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function counts()
    {
        $products = Product::count();
        $category = Category::count();
        $subcategory = Subcategory::count();
        $brands = Brand::count();
        $orders = Order::count();
        $users = User::count();
        // return $products;
        return view('admin.dashboard', compact('products', 'category', 'subcategory', 'brands', 'orders', 'users'));
    }
    public function create()
    {
        $admin = Admin::create([
            'name' => 'Muhammad Rafay Shaikh',
            'phone' => 03153307757,
            'email' => 'rafay6744@gmail.com',
            'password' => 'rafay6744',
            'role' => 2
        ]);
    }

    public function reviews()
    {
        $reviews = Review::with('user', 'product')->orderBy('id', 'DESC')->paginate(2);

        return view('admin.reviews', compact('reviews'));
    }

    public function deleteReview(string $id)
    {
        $review = Review::findOrFail($id);

        $review->delete();

        return redirect()->route('adminreviews')->with('review', 'Review Deleted Successfully');
    }
}
