<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AccountController;
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
    return view('mainpage');
})->middleware(['auth', 'verified'])->name('mainpage');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', function () {
        return view('dashboard');
    });

    Route::get('/refbooks', function () {
        return view('refbooks');
    })->name('refbooks');
    Route::get('/refbooks/accounts', [AccountController::class, 'show'])->name('account.show');
    Route::post('/refbooks/accounts/save', [AccountController::class, 'save'])->name('account.save');
    Route::post('/refbooks/accounts/delete', [AccountController::class, 'delete'])->name('account.delete');

});

require __DIR__.'/auth.php';
