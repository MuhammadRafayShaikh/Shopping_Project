<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategory = Subcategory::with('category')->orderBy('id', 'DESC')->paginate(1);

        // return $subcategory;

        return view('admin.sub_category', compact('subcategory'));
    }

    // app/Http/Controllers/SubCategoryController.php
    public function updateHeaderStatus(Request $request)
    {
        $subcategory = SubCategory::find($request->id);
        $subcategory->s_i_header = $request->s_i_header;
        $subcategory->save();

        return response()->json(['message' => 'Header status updated successfully!']);
    }

    public function updateFooterStatus(Request $request)
    {
        $subcategory = SubCategory::find($request->id);
        $subcategory->s_i_footer = $request->s_i_footer;
        $subcategory->save();

        return response()->json(['message' => 'Footer status updated successfully!']);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        // return $category;
        return view('admin.add_sub_category', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $subcategoryValidation = validator($request->all(), [
            'c_name' => 'required',
            'c_id' => 'required'
        ]);

        $subcategory = Subcategory::create([
            'sub_cat_name' => $request->c_name,
            'cat_name' => $request->c_id
        ]);

        if ($subcategory) {
            return redirect()->route('subcategory.index')->with('subcategory', 'Sub Category Added Successfully');
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
        $category = Category::all();
        $subcategory = Subcategory::find($id);

        return view('admin.edit_sub_category', compact('category', 'subcategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $subcategoryValidation = validator($request->all(), [
            'c_name' => 'required',
            'c_id' => 'required'
        ]);

        $subcategory = Subcategory::find($id);

        $subcategory->update([
            'sub_cat_name' => $request->c_name,
            'cat_name' => $request->sc_id
        ]);

        if ($subcategory) {
            return redirect()->route('subcategory.index')->with('subcategory', 'Sub Category Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
