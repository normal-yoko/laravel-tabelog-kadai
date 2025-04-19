<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Store;
use App\Models\Favorite;



class FavoriteController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $favorites_stores = $user->favorite_stores;

        return view('favorites.index', compact('favorites_stores'));
    }


    public function store($store_id)
    {
        Auth::user()->favorite_stores()->attach($store_id);

        return back()->with('status', 'お気に入りに登録しました。');
    }

    public function destroy($store_id)
    {
        Auth::user()->favorite_stores()->detach($store_id);

        return back()->with('status', 'お気に入り登録を解除しました。');
    }
}