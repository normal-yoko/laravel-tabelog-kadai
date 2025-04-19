<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ReserveController;
use App\Http\Controllers\Auth\PasswordController;

use Illuminate\Support\Facades\Route;

Route::get('/',[WebController::class,'index'])->name('top');
//Route::get('stores',[StoreController::class,'index'])->name('stores.index');
Route::resource('stores', storeController::class);
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
   
//    Route::resource('stores', storeController::class);
    Route::get('favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('favorites/{store_id}', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('favorites/{store_id}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');

    Route::resource('checkouts', CheckoutController::class,['only'=>['index','destroy']]);

    Route::controller(CheckoutController::class)->group(function () {
    Route::get('checkout/success', 'success')->name('checkout.success');
    Route::get('/update-card', 'updateCard')->name('checkout.updateCard');
    Route::get('/update-card/success','updateCardSuccess')->name('checkout.updateCard.success');
    });   

    Route::get('/card', [CheckoutController::class, 'showCard'])->name('checkout.card');

    Route::middleware(['auth'])->group(function () {
        Route::get('/password/edit', [PasswordController::class, 'editPassword'])->name('password.edit');
        Route::post('/password/update', [PasswordController::class, 'updatePassword'])->name('password.update');
    });

    
});