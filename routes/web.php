<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\ServicesController;
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
    return view('home');
});
Route::resource('site', SiteController::class);
Route::resource('services', ServicesController::class);
Route::resource('contacts', ContactsController::class);

Route::resource('categories', CategoriesController::class);
Route::resource('operations', OperationsController::class);
Route::get('/filterCategory', [App\Http\Controllers\OperationsController::class, 'filterCategory'])->name('filterCategory');
Route::get('/filterYear', [App\Http\Controllers\OperationsController::class, 'filterYear'])->name('filterYear');
Route::get('/filterMonth', [App\Http\Controllers\OperationsController::class, 'filterMonth'])->name('filterMonth');

Route::get('generate-pdf', [OperationsController::class, 'pdf'])->name('generatePdf');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/users', App\HTTP\Controllers\UserController::class)->except('create', 'store');