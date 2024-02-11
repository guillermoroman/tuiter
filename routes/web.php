<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TuitController;
use App\Http\Controllers\FollowController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Rutas para Tuit agrupadas como recurso.
Route::resource('tuits', TuitController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

    
//Ruta a un index que solo muestre los tuits de los usuarios seguidos.
Route::get('/tuits/followed', [TuitController::class, 'index_followed'])
    ->name('tuits.index_followed')
    ->middleware(['auth', 'verified']);


// Ruta para establecer un nuevo Follow
Route::post('/follow', [FollowController::class, 'store'])
    ->name('follow.store');

// Ruta para borrar un Follow
Route::delete('/unfollow/{user}', [FollowController::class, 'destroy'])
    ->name('follow.destroy');



require __DIR__.'/auth.php';
