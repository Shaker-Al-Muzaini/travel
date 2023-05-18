<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\ArticlesController;
use App\Http\Controllers\Admin\FooterController;
use App\Http\Controllers\Admin\HotelController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\propertiesController;
use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RestaurantsController;
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
Route::middleware('auth')->group(function () {
Route::get('/', function () {
    return view('dashboard.dashboard');
})->name('home');

    Route::get('/profile', function () {
        return view('dashboard.profile');
    })->name('profile');

    Route::get('/Hotels',[HotelController::class,'index2'])->name('hotel');
    Route::get('/Hotels/create',[HotelController::class,'create'])
        ->name('hotel.create');
    Route::post('/Hotels/store',[HotelController::class,'store'])
        ->name('hotel.store');
    Route::get('/Hotels/edit/{id}',[HotelController::class,'edit'])
        ->name('hotel.edit');
    Route::put('/Hotels/update/{id}',[HotelController::class,'update'])
        ->name('hotel.update');
    Route::delete('/Hotels/delete/{id}',[HotelController::class,'destroy'])
        ->name('hotel.delete');


    Route::get('/properties',[propertiesController::class,'index2'])->name('propertie');
    Route::get('/properties/create',[propertiesController::class,'create'])
        ->name('properties.create');
    Route::post('/properties/store',[propertiesController::class,'store'])
        ->name('properties.store');
    Route::get('/properties/edit/{id}',[propertiesController::class,'edit'])
        ->name('properties.edit');
    Route::put('/properties/update/{id}',[propertiesController::class,'update'])
        ->name('properties.update');
    Route::delete('/properties/delete/{id}',[propertiesController::class,'destroy'])
        ->name('properties.delete');


    Route::get('/Restaurants',[RestaurantsController::class,'index2'])->name('restaurants');
    Route::get('/Restaurants/create',[RestaurantsController::class,'create'])
        ->name('restaurants.create');
    Route::post('/Restaurants/store',[RestaurantsController::class,'store'])
        ->name('restaurants.store');
    Route::get('/Restaurants/edit/{id}',[RestaurantsController::class,'edit'])
        ->name('restaurants.edit');
    Route::put('/Restaurants/update/{id}',[RestaurantsController::class,'update'])
        ->name('restaurants.update');
    Route::delete('/Restaurants/delete/{id}',[RestaurantsController::class,'destroy'])
        ->name('restaurants.delete');



    Route::get('/Article',[ArticlesController::class,'index2'])->name('articles');
    Route::get('/Article/create',[ArticlesController::class,'create'])
        ->name('articles.create');
    Route::post('/Article/store',[ArticlesController::class,'store'])
        ->name('articles.store');
    Route::get('/Article/edit/{id}',[ArticlesController::class,'edit'])
        ->name('articles.edit');
    Route::put('/Article/update/{id}',[ArticlesController::class,'update'])
        ->name('articles.update');
    Route::delete('/Article/delete/{id}',[ArticlesController::class,'destroy'])
        ->name('articles.delete');

    Route::get('/About',[AboutController::class,'index2'])->name('about');
    Route::get('/About/edit/{id}',[AboutController::class,'edit'])
        ->name('about.edit');
    Route::put('/About/update/{id}',[AboutController::class,'update'])
        ->name('about.update');

    Route::get('/Footer',[FooterController::class,'index2'])->name('footer');
    Route::get('/Footer/edit/{id}',[FooterController::class,'edit'])
        ->name('footer.edit');
    Route::put('/Footer/update/{id}',[FooterController::class,'update'])
        ->name('footer.update');


    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
});

require __DIR__.'/auth.php';
