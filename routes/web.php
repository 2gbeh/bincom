<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|

#! In order to use the Auth::routes() method, please install the laravel/ui package.
Auth::routes([
'register' =>  false
]);

*/

Route::controller(MainController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/create', 'create');
    Route::post('/create', 'store');
    Route::get('/search', 'search');
    Route::get('/{id}', 'show')->where('id', '[0-9]+');
});

# AUTH ROUTES
include_once __DIR__ . '/auth.php';
