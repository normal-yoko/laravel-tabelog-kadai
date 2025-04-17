<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ReserveController;

use Illuminate\Support\Facades\Route;

Route::get('/',[WebController::class,'index'])->name('top');

require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {
   // Route::GET('stores/{store}',[storeController::class,'index'])->name('store.index');
    Route::get('reviews', [ReviewController::class, 'index'])->name('reviews.index');
//    Route::DELETE('reviews', [ReviewController::class, 'destroy'])->name('reviews.destroy');
    Route::post('reviews',[ReviewController::class,'store'])->name('reviews.store');
    Route::post('reviews',[ReviewController::class,'edit'])->name('reviews.edit');
    Route::get('reviews',[ReviewController::class,'update'])->name('reviews.update');
    route::resource('reviews',ReviewController::class);


    Route::get('reserves', [ReserveController::class, 'index'])->name('reserves.index');
    Route::get('reserves/{store_id}',[ReserveController::class,'create'])->name('reserves.create')->where('id', '[0-9]+');
    Route::post('reserves', [ReserveController::class, 'store'])->name('reserves.store');
//    Route::get('reserves/{id}', [ReserveController::class, 'edit'])->name('reserves.edit')->where('id', '[0-9]+');
    Route::delete('reserves/{reserve}', [ReserveController::class, 'destroy'])->name('reserves.destroy');   
    Route::resource('reserves', ReserveController::class, ['only'=>['edit','update']]);
   
    Route::resource('stores', storeController::class);
    Route::get('favorites}', [FavoriteController::class, 'index'])->name('favorites.index');

    Route::post('favorites/{store_id}', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('favorites/{store_id}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
    
    Route::controller(CheckoutController::class)->group(function () {
    Route::resource('checkouts', CheckoutController::class,['only'=>['index','destroy']]);
    Route::get('checkout/success', 'success')->name('checkout.success');
    });   
});


