<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\WebController;

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

Route::get('reviews',[ReviewController::class,'show'])->name('reviews.show');
Route::post('reviews',[ReviewController::class,'show'])->name('reviews.show');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('stores', storeController::class);
    Route::post('stores/{store}',[storeController::class,'index'])->name('store.index');
    Route::post('reviews', [ReviewController::class, 'store'])->name('reviews.store');

    Route::post('favorites/{store_id}', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('favorites/{store_id}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
});