<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function destroy(Request $request)
    {
        $id = $request->review_id;
        $review = Review::findOrFail($id);
        $review->delete();

        return response()->json(['success' => 'Review Deleted Successfully']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'product_id' => 'required',
            'score' => 'required|numeric|min:1|max:5',
            'review' => 'nullable|string',
        ]);

        $id = Review::create([
            'user_id' => $request-> user_id ,
            'product_id' => $request-> product_id ,
            'score' => $request-> score ,
            'review' => $request-> review
        ])->id;

        return response()->json([
            'success' => "Review Added Successfully",
            'id' => $id
        ]);
    }
    
}
