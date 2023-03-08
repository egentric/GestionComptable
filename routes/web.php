<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\OperationsController;

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

Route::resource('categories', CategoriesController::class);
Route::resource('operations', OperationsController::class);
Route::get('/filterCategory', [App\Http\Controllers\OperationsController::class, 'filterCategory'])->name('filterCategory');
Route::get('/filterYear', [App\Http\Controllers\OperationsController::class, 'filterYear'])->name('filterYear');
Route::get('/filterMonth', [App\Http\Controllers\OperationsController::class, 'filterMonth'])->name('filterMonth');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
