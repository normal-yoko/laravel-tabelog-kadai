<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $category = $request->input('category_id');

        if($category !== null && $keyword !== null){
            $stores = Store::where([['name','like','%'.$keyword.'%'],['category_id','=',$category]])->get();
        }elseif($category == null && $keyword !== null){
            $stores = Store::where('name','like','%'.$keyword.'%')->get();
        }else if($category !== null && $keyword == null){
            $stores = Store::where('category_id','=',$category)->get();
        }else{
            $stores = Store::all();
        }

        $categories = Category::all();

//        $stores = Store::where('name','like','%'.$keyword.'%')->get();

//      $stores = Store::paginate(8);

        return view('stores.index', compact('stores','categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('stores.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $store = new store();
            $store->category_id = $request->input('category_id');
            $store->name = $request->input('name');
            $store->description = $request->input('description');
            $store->under_price = $request->input('under_price');
            $store->upper_price = $request->input('upper_price');
            $store->open_time = $request->input('open_time');
            $store->closed_time = $request->input('closed_time');
            $store->postal_code = $request->input('postal_code');
            $store->address = $request->input('address');
            $store->phone = $request->input('phone');
            $store->closed_day = $request->input('closed_day');
//            $store->picture = $request->input('picture');
            //画像の読み込みはよくわからないのでとりえずaaaを登録
            //必要であれば事前にダウンロードしたファイル名を決め打ちで登録
            $store->picture = 'aaa';

            $store->save();
    
            return to_route('stores.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Store $store)
    {
        //外部キーを使ってCategoryテーブルを連結したStoreテーブルを再取得☆彡
//        $store_foreign = Store::with('category')->where('id',$store->id);
//        return view('stores.show', compact('store_foreign'));
//        $store = Store::with('category')->where('id',$store->id);
//        return view('stores.show', compact('store'));
    return view('stores.show', compact('store'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Store $store)    {

        $categories = Category::all();

        return view('stores.edit', compact('store','categories'));
   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Store $store)
    {
        $store->category_id = $request->input('category_id');
        $store->name = $request->input('name');
        $store->description = $request->input('description');
        $store->under_price = $request->input('under_price');
        $store->upper_price = $request->input('upper_price');
        $store->open_time = $request->input('open_time');
        $store->closed_time = $request->input('closed_time');
        $store->postal_code = $request->input('postal_code');
        $store->address = $request->input('address');
        $store->phone = $request->input('phone');
        $store->closed_day = $request->input('closed_day');
//            $store->picture = $request->input('picture');
        //画像の読み込みはよくわからないのでとりえずaaaを登録
        //必要であれば事前にダウンロードしたファイル名を決め打ちで登録
        $store->picture = 'aaa';


        $store->update();

        return to_route('stores.index');
        //
    }

    /*
            $table->foreignId('category_id')->constrained()->cascadeOnDelete(); //$table->integer('category_id')->unsigned(); 

            $table->string('name');  //店名
            $table->string('picture'); //画像
            $table->text('description');  //説明
            $table->integer('under_price')->unsigned(); //価格帯(下限)
            $table->integer('upper_price')->unsigned(); //価格帯(上限)
            $table->string('open_time')->default(''); //営業時間(開店)
            $table->string('closed_time')->default('');  //営業時間(閉店)
            $table->string('postal_code')->default('');  //郵便番号
            $table->string('address');  //住所
            $table->string('phone')->default('');  //電話番号
            $table->string('closed_day');  //定休日

    */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Store $store)
    {
        //
        $store->delete();
 
        return to_route('stores.index');
    }

}
