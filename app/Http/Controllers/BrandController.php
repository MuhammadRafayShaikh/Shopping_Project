<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::with('category')->orderBy('id', 'DESC')->paginate(1);


        return view('admin.brands', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subcategory = Subcategory::all();
        return view('admin.add_brand', compact('subcategory'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $brandValidation = validator(
            $request->all(),
            [
                'brand_name' => 'required',
                'brand_cat' => 'required'
            ]
        );

        $brand = Brand::create([
            'brand' => $request->brand_name,
            'brand_cat' => $request->brand_cat
        ]);

        if ($brand) {
            return redirect()->route('brand.index')->with('brand', 'Brand Added Successfully');
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
        $category = Subcategory::all();
        $brand = Brand::find($id);

        return view('admin.edit_brand', compact('category', 'brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $brandValidation = validator(
            $request->all(),
            [
                'brand_name' => 'required',
                'brand_cat' => 'required'
            ]
        );
        $brand = Brand::find($id);
        $brand->update([
            'brand' => $request->brand_name,
            'brand_cat' => $request->brand_cat
        ]);

        if ($brand) {
            return redirect()->route('brand.index')->with('brand', 'Brand Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::find($id);

        $brand->delete();

        if ($brand) {
            return redirect()->route('brand.index')->with('brand', 'Brand Delete Successfully');
        }
    }
}
