<?php

namespace App\Http\Controllers;

use App\Models\Reserve;
use App\Models\Store;
use App\Models\User;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReserveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($sotre_id)
    {
        $user_id = Auth::user()->id;
        $store = Store::find($sotre_id);

        return view('reserves.index', compact('user_id','store'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($store_id)
    {

    // デバッグ用ログ出力
    \Log::info("Trying to find store with ID: {$store_id}");
    
    $store = Store::find($store_id);

    if (!$store) {
        \Log::error("Store with ID {$store_id} not found.");
        abort(404, 'Store not found');
    }

        $current_date = Carbon::now();

        return view('reserves.create',compact('store','current_date'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'reservation_date' => 'required',
            'reservation_time' => 'required',
            'headcount' => 'required',
        ]);

        $reserve = new Reserve();
        $reserve->user_id = Auth::user()->id;
        $reserve->store_id = $request->input('store_id');
        $reserve->reservation_date = $request->input('reservation_date');
        $reserve->reservation_time = $request->input('reservation_time');
        $reserve->headcount = $request->input('headcount');
        $reserve->save();

        return to_route('stores.index');



        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Reserve $reserve)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reserve $reserve)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reserve $reserve)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reserve $reserve)
    {
        //
    }
}
