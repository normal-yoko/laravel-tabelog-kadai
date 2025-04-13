<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Store;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    public function index($id)
    {
        $store = Store::find($id);
        $reviews = $store->reviews()->get();

        return view('reviews.index', compact('store','reviews'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required'
        ]);

        $review = new Review();
        $review->content = $request->input('content');
        $review->store_id = $request->input('store_id');
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
         //
         $review->delete();
 
         return to_route('stores.index');
    }
}
