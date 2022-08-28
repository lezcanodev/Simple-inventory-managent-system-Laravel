<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Models\Product;

Route::get('/', function () {
    return view('welcome');
})->name('login')->middleware('guest');




Route::middleware('auth')->group(function(){

    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');

    /**
     * PROVIDERS
    */
    Route::prefix('providers')->controller(ProviderController::class)->name('provider.')->group(function(){
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');

        Route::post('/', 'store')->name('store');
        Route::delete('/', 'destroy' )->name('destroy');
    });
   

    /**
     * PRODUCTS
     */
    Route::prefix('products')->controller(ProductController::class)->name('product.')->group(function(){
        Route::get('/', 'index' )->name('index');
        Route::get('/create/{provider:id?}', 'create' )->name('create');
        Route::get('/update/{product:id}', 'update' )->name('update');
        
        Route::get('/{product}', 'view' )->name('view');

        Route::delete('/', 'destroy' )->name('destroy');
        Route::post('/',   'store' )->name('store');
        Route::put('/',    'updated' )->name('updated');
    });

    /**
     * Categories
     */
    Route::prefix('categories')->controller(CategoryController::class)->name('category.')->group(function(){
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::get('/update/{category:id}', 'update' )->name('update');

        Route::post('/', 'store')->name('store');
        Route::delete('/', 'destroy')->name('destroy');
        Route::put('/', 'updated')->name('updated');
    });

    /**
     * Roles
     */
    Route::prefix('roles')->controller(RolController::class)->name('rol.')->group(function(){
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');

        Route::delete('/', 'destroy')->name('destroy');
        Route::post('/', 'store')->name('store');
    });

    /**
     * USERS
     */
    Route::prefix('users')->controller(UserController::class)->name('user.')->group(function(){
        Route::get('/', 'index')->name('index');

        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::post('/auth', 'auth')->name('auth')->withoutMiddleware('auth');
        Route::get('/logout', 'logout')->name('logout');

        Route::delete('/', 'destroy')->name('destroy');
    });



});



