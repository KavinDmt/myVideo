<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VideoLikeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/video/search', [HomeController::class, 'search'])->name('products.search');
Route::post('/like', [VideoLikeController::class, 'toggle'])->name('video.toggleLike');


/* Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/cabinet/myvideo', [HomeController::class, 'myvideo']);
    Route::get('/cabinet/load', [VideoLikeController::class, 'create'])->name('cabinet.load');
    Route::post('/cabinet/load', [VideoLikeController::class, 'store'])->name('cabinet.store');
}); 

require __DIR__.'/auth.php';
