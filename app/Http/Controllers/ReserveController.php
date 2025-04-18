<?php

namespace App\Http\Controllers;

use App\Models\Reserve;
use App\Models\Store;
use App\Models\User;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReserveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $reserves = Reserve::orderBy('reservation_date', 'asc')->get();
        $current_date = Carbon::now();

        return view('reserves.index', compact('reserves','current_date'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($store_id)
    {

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
    public function edit($id)
    {
//        $reserve = Reserve::find($id);
        $reserve = Reserve::findOrFail($id);
        $current_date = Carbon::now();

        return view('reserves.edit', compact('reserve','current_date'));
    }

    /**
     * Update the specified resource in storage.
     */
        public function update(Request $request, Reserve $reserve)
        {
            // リクエストデータをログに記録
            Log::debug('Update Request Data: ', $request->all());
        
            $validatedData = $request->validate([
                'reservation_date' => 'required|date',
                'reservation_time' => 'required',
                'headcount' => 'required|integer',
                'id' => 'required'
            ]);
        
            $reserve2 = Reserve::find($request->id);

            $reserve2->reservation_date = $validatedData['reservation_date'];
            $reserve2->reservation_time = $validatedData['reservation_time'];
            $reserve2->headcount = $validatedData['headcount'];
            $reserve2->update();
      
            return to_route('reserves.index');
        }   

    /**
     * Remove the specified resource from storage.
     */

     public function destroy(Reserve $reserve)
     {
         // Reserveモデルが正しく渡されていれば、削除処理を行います
         $reserve->delete();
         return to_route('reserves.index');
     }
}
