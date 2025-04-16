<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ReserveController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
*/
Route::get('/',[WebController::class,'index'])->name('top');

//Route::get('/reviews/{id}', [ReviewController::class, 'index'])->name('reviews.index');

require __DIR__.'/auth.php';

//Route::resource('stores', StoreController::class);
//Route::resource('reviews', ReviewController::class);

//Route::get('reviews',[ReviewController::class,'show'])->name('reviews.show');

Route::middleware(['auth', 'verified'])->group(function () {
   // Route::GET('stores/{store}',[storeController::class,'index'])->name('store.index');
    Route::get('reviews', [ReviewController::class, 'index'])->name('reviews.index');
//    Route::DELETE('reviews', [ReviewController::class, 'destroy'])->name('reviews.destroy');
    Route::post('reviews',[ReviewController::class,'store'])->name('reviews.store');
    Route::post('reviews',[ReviewController::class,'edit'])->name('reviews.edit');
    Route::post('reviews',[ReviewController::class,'update'])->name('reviews.update');
    route::resource('reviews',ReviewController::class);
    Route::get('reserves/{store_id}', [ReserveController::class, 'index'])->name('reserves.index');
   
    Route::resource('stores', storeController::class);
//    Route::resource('reserves', ReserveController::class);
    Route::get('favorites}', [FavoriteController::class, 'index'])->name('favorites.index');

    Route::post('favorites/{store_id}', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('favorites/{store_id}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
    
    Route::controller(CheckoutController::class)->group(function () {
        Route::resource('checkouts', CheckoutController::class,['only'=>['index','destroy']]);
        Route::get('checkout/success', 'success')->name('checkout.success');
    });   
});


