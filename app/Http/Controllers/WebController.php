<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Category;

class WebController extends Controller
{
    //
    public function index()
    {
        $stores = Store::all();
        $categories = Category::all();

        return view('web.index', compact('stores','categories'));
    }
}
