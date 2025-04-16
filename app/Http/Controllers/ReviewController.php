<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Store;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $reviews = $user->reviews()->get();

        return view('reviews.index', compact('reviews'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required'
        ]);

        $review = new Review();
        $review->comment = $request->input('comment');
        $review->store_id = $request->input('store_id');
        $review->star_count = $request->input('star_count');
        $review->user_id = Auth::user()->id;
        $review->save();

        return back();


    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
//        $reviews = $store->reviews()->get();
//        $reviews = $store->reviews()->get();
//            $reviews = Review::where("store_id",$id);
//            $reviews = Review::find(1);
//        $reviews = Review::all();
        
//        return view('reviews.show');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
        return view('reviews.edit',compact('review'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        $review->comment = $request->input('comment');
        $review->star_count = $request->input('star_count');

        $review->update();

        return to_route('reviews.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
         //
         $review->delete();
 
         return to_route('reviews.index');
        }
}
