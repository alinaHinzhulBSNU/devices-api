<?php

use App\Http\Controllers\BrandsController;
use App\Http\Controllers\CitiesController;
use App\Http\Controllers\CountriesController;
use App\Http\Controllers\DevicesController;
use App\Http\Controllers\ModelsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Countries
Route::get('/countries/search/{country_name}', [CountriesController::class, 'search']);
Route::resource('/countries', "\App\Http\Controllers\CountriesController");

// Cities
Route::get('/cities/search/{city_name}', [CitiesController::class, 'search']);
Route::resource('/cities', "\App\Http\Controllers\CitiesController");

// Brands
Route::get('/brands/search/{brand_name}', [BrandsController::class, 'search']);
Route::resource('/brands', "\App\Http\Controllers\BrandsController");

// Models
Route::get('/models/search/{model_name}', [ModelsController::class, 'search']);
Route::resource('/models', "\App\Http\Controllers\ModelsController");

// Devices
Route::get('/devices/search/{max_price}', [DevicesController::class, 'search']);
Route::resource('/devices', "\App\Http\Controllers\DevicesController");

// Orders
Route::resource('/orders', "\App\Http\Controllers\OrdersController");

// Items
Route::resource('/items', "\App\Http\Controllers\ItemsController");
