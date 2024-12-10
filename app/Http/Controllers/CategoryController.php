<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::orderBy('id')->orderBy('id', 'DESC')->paginate(1);
        return view('admin.category', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.add_category');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $categoryValidation = validator($request->all(), [
            'c_name' => 'required'
        ]);

        $category = Category::create([
            'category_name' => $request->c_name,

        ]);

        if ($category) {
            return redirect()->route('category.index')->with('category', 'Category Added Successfully');
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
        $category = Category::find($id);

        return view('admin.edit_cat', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $categoryValidation = validator($request->all(), [
            'c_name' => 'required'
        ]);

        $category = Category::find($id);

        $category->update([
            'category_name' => $request->c_name
        ]);

        if ($category) {
            return redirect()->route('category.index')->with('category', 'Category Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);

        $category->delete();

        if ($category) {
            return redirect()->route('category.index')->with('category', 'Category Deleted Successfully');
        }
    }
}
