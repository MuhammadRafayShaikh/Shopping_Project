<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $reviewValidation = validator($request->all(), [
            'rating' => 'required',
            'comment' => 'required|max:100'
        ]);

        $review = Review::create([
            'user_id' => Auth::id(),
            'product_id' => $id,
            'rating' => $request->rating,
            'comment' => $request->comment
        ]);

        return redirect()->route('singleProduct', $id)->with('review', 'Review Added Successfully');
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
    public function destroy(string $id, string $pid)
    {
        $review = Review::find($id);
        // return $review;
        // return $review->product_id;

        $review->delete();

        return redirect()->route('singleProduct', $pid)->with('review', 'Review Deleted Successfully');
    }
}
