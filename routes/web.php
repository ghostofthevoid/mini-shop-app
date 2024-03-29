<?php

use Illuminate\Support\Facades\Auth;
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


Route::prefix('admin')->middleware('IsAdmin')->group(function () {

    Route::get('/', \App\Http\Controllers\Main\IndexController::class)->name('main.index');



    Route::prefix('categories')->group(function () {
        Route::get('/', \App\Http\Controllers\Category\IndexController::class)->name('category.index');
        Route::get('/create', \App\Http\Controllers\Category\CreateController::class)->name('category.create');
        Route::post('/', \App\Http\Controllers\Category\StoreController::class)->name('category.store');
        Route::get('/{category}', \App\Http\Controllers\Category\ShowController::class)->name('category.show');
        Route::get('/{category}/edit', \App\Http\Controllers\Category\EditController::class)->name('category.edit');
        Route::patch('/{category}', \App\Http\Controllers\Category\UpdateController::class)->name('category.update');
        Route::delete('/{category}', \App\Http\Controllers\Category\DeleteController::class)->name('category.delete');
    });

    Route::prefix('colors')->group(function () {
        Route::get('/', \App\Http\Controllers\Color\IndexController::class)->name('color.index');
        Route::get('/create', \App\Http\Controllers\Color\CreateController::class)->name('color.create');
        Route::post('/', \App\Http\Controllers\Color\StoreController::class)->name('color.store');
        Route::get('/{color}', \App\Http\Controllers\Color\ShowController::class)->name('color.show');
        Route::get('/{color}/edit', \App\Http\Controllers\Color\EditController::class)->name('color.edit');
        Route::patch('/{color}', \App\Http\Controllers\Color\UpdateController::class)->name('color.update');
        Route::delete('/{color}', \App\Http\Controllers\Color\DeleteController::class)->name('color.delete');
    });

    Route::prefix('tags')->group(function () {
        Route::get('/', \App\Http\Controllers\Tag\IndexController::class)->name('tag.index');
        Route::get('/create', \App\Http\Controllers\Tag\CreateController::class)->name('tag.create');
        Route::post('/', \App\Http\Controllers\Tag\StoreController::class)->name('tag.store');
        Route::get('/{tag}', \App\Http\Controllers\Tag\ShowController::class)->name('tag.show');
        Route::get('/{tag}/edit', \App\Http\Controllers\Tag\EditController::class)->name('tag.edit');
        Route::patch('/{tag}', \App\Http\Controllers\Tag\UpdateController::class)->name('tag.update');
        Route::delete('/{tag}', \App\Http\Controllers\Tag\DeleteController::class)->name('tag.delete');
    });

    Route::prefix('users')->group(function () {
        Route::get('/', \App\Http\Controllers\User\IndexController::class)->name('user.index');
        Route::get('/create', \App\Http\Controllers\User\CreateController::class)->name('user.create');
        Route::post('/', \App\Http\Controllers\User\StoreController::class)->name('user.store');
        Route::get('/{user}', \App\Http\Controllers\User\ShowController::class)->name('user.show');
        Route::get('/{user}/edit', \App\Http\Controllers\User\EditController::class)->name('user.edit');
        Route::patch('/{user}', \App\Http\Controllers\User\UpdateController::class)->name('user.update');
        Route::delete('/{user}', \App\Http\Controllers\User\DeleteController::class)->name('user.delete');
    });

    Route::prefix('products')->group(function () {
        Route::get('/', \App\Http\Controllers\Product\IndexController::class)->name('product.index');
        Route::get('/create', \App\Http\Controllers\Product\CreateController::class)->name('product.create');
        Route::post('/', \App\Http\Controllers\Product\StoreController::class)->name('product.store');
        Route::get('/{product}', \App\Http\Controllers\Product\ShowController::class)->name('product.show');
        Route::get('/{product}/edit', \App\Http\Controllers\Product\EditController::class)->name('product.edit');
        Route::patch('/{product}', \App\Http\Controllers\Product\UpdateController::class)->name('product.update');
        Route::delete('/{product}', \App\Http\Controllers\Product\DeleteController::class)->name('product.delete');
    });


});



Route::prefix('client')->group( function () {

    Route::get('/products', [\App\Http\Controllers\API\ProductController::class, 'index'] );

    Route::get('/orders', [\App\Http\Controllers\API\OrderController::class, 'index'] );
    Route::post('/orders', [\App\Http\Controllers\API\OrderController::class, 'store'] );


    Route::get('/favorites', [\App\Http\Controllers\API\FavoriteController::class, 'index'] );
    Route::post('/favorites', [\App\Http\Controllers\API\FavoriteController::class, 'store'] );
    Route::delete('/favorites/{favorite}', [\App\Http\Controllers\API\FavoriteController::class, 'destroy'] );
});

Auth::routes();

Route::get('/register', function () {
    return redirect('user/register');
});
Route::get('/login', function () {
    return redirect('user/login');
});
Route::get('/', function () {
    return redirect('user/login');
});

Route::get('{page}', \App\Http\Controllers\Client\IndexController::class)->where('page', '.*');


