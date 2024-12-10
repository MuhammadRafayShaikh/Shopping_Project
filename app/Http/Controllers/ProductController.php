<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('subcategory', 'brand')->orderBy('id', 'DESC')->paginate(2);
        // return $products;
        return view('admin.products', compact('products'));
    }

    public function getSubcategories($category_id)
    {
        $subcategories = Subcategory::where('cat_name', $category_id)->get(); // Assuming 'cat_id' is the foreign key in subcategories table
        return response()->json($subcategories);
    }


    public function brands(string $sub_category_id)
    {
        $brands = Brand::where('brand_cat', $sub_category_id)->get();
        return response()->json($brands);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        return view('admin.add_product', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $productValidation = validator($request->all(), [
            'product_title' => 'required',
            'product_cat' => 'required',
            'product_sub_cat' => 'required',
            'product_brand' => 'required',
            'product_desc' => 'required|max:255',
            'product_price' => 'required|number',
            'product_qty' => 'required|number',
            'image' => 'required|image|mimes:png,jpg,jpeg,webp,gif',
        ]);

        $file = $request->file('image');

        $fileExtension = $file->getClientOriginalExtension();

        $filename = time() . '.' . $fileExtension;

        $file->move(public_path('uploads/'), $filename);

        $cat_products = Subcategory::find($request->product_sub_cat);
        $cat_products->update([
            'cat_products' => $cat_products->cat_products + 1
        ]);

        $products = Product::create([
            'product_name' => $request->product_title,
            'product_desc' => $request->product_desc,
            'product_price' => $request->product_price,
            'product_image' => $filename,
            'product_qty' => $request->product_qty,
            'product_cat' => $request->product_cat,
            'product_sub_cat' => $request->product_sub_cat,
            'product_brand' => $request->product_brand
        ]);

        if ($products && $cat_products) {
            return redirect()->route('product.index')->with('product', 'Product Added Successfully');
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

        $product = Product::find($id);

        $category = Category::all();
        $subcategory = Subcategory::where('id', $product->category_id)->get();
        $brands = Brand::where('id', $product->subcategory_id)->get();



        return view('admin.edit_product', compact('category', 'subcategory', 'brands', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $productValidation = validator($request->all(), [
            'product_title' => 'required',
            'product_cat' => 'required',
            'product_sub_cat' => 'required',
            'product_brand' => 'required',
            'product_desc' => 'required|max:255',
            'product_price' => 'required|number',
            'product_qty' => 'required|number',
            'image' => 'required|image|mimes:png,jpg,jpeg,webp,gif',
        ]);

        $productImage = Product::select('id', 'product_image')->find($id);
        if ($request->file('image') != "" || $request->file('image') != null) {
            $path = public_path('uploads/' . $productImage->product_image);
            if (file_exists($path) && $productImage->product_image) {
                unlink($path);
            }
            $file = $request->file('image');

            $fileExtension = $file->getClientOriginalExtension();

            $filename = time() . '.' . $fileExtension;

            $file->move(public_path('uploads/'), $filename);
        } else {
            $filename = $productImage->product_image;
        }

        if ($request->product_old_sub_cat != $request->product_sub_cat) {
            $product_sub_cat = Subcategory::find($request->product_sub_cat);
            $product_sub_cat->update([
                'cat_products' => $product_sub_cat->cat_products + 1
            ]);

            $product_old_sub_cat = Subcategory::find($request->product_old_sub_cat);
            $product_old_sub_cat->update([
                'cat_products' => $product_old_sub_cat->cat_products - 1
            ]);
        }

        $product = Product::find($id);
        $product->update([
            'product_name' => $request->product_title,
            'product_desc' => $request->product_desc,
            'product_price' => $request->product_price,
            'product_image' => $filename,
            'product_qty' => $request->product_qty,
            'product_cat' => $request->product_cat,
            'product_sub_cat' => $request->product_sub_cat,
            'product_brand' => $request->product_brand
        ]);

        if ($product) {
            return redirect()->route('product.index')->with('product', 'Product Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, string $cat_id)
    {
        $subcategory = Subcategory::find($cat_id);
        $subcategory->update([
            'cat_products' => $subcategory->cat_products - 1
        ]);

        $product = Product::find($id);

        $product->delete();

        if ($product && $subcategory) {
            return redirect()->route('product.index')->with('product', 'Product Deleted Successfully');
        }
    }
}
