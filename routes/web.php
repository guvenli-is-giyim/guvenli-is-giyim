<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| FRONTEND CONTROLLERS
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\QuoteController;


/*
|--------------------------------------------------------------------------
| ADMIN CONTROLLERS
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\ProductAttributeController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\QuoteRequestController;
use App\Http\Controllers\Admin\BannerController;


/*
|--------------------------------------------------------------------------
| ANA SAYFA
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('home');


/*
|--------------------------------------------------------------------------
| ÜRÜNLER
|--------------------------------------------------------------------------
*/

Route::get('/shop', [ShopController::class, 'index'])
    ->name('shop');


/*
|--------------------------------------------------------------------------
| ÜRÜN DETAY
|--------------------------------------------------------------------------
*/

Route::get('/urun/{product}', [ShopController::class, 'show'])
    ->name('product.show');


/*
|--------------------------------------------------------------------------
| TEKLİF AL
|--------------------------------------------------------------------------
*/

Route::get('/teklif-al', [QuoteController::class, 'create'])
    ->name('quote.create');

Route::post('/teklif-al', [QuoteController::class, 'store'])
    ->name('quote.store');


/*
|--------------------------------------------------------------------------
| ADMIN GİRİŞ
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [AuthController::class, 'showLogin'])
    ->name('admin.login');

Route::post('/admin/login', [AuthController::class, 'login'])
    ->name('admin.login.submit');

Route::post('/admin/logout', [AuthController::class, 'logout'])
    ->name('admin.logout');


/*
|--------------------------------------------------------------------------
| ADMIN PANEL
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {


    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | KATEGORİLER
    |--------------------------------------------------------------------------
    */

    Route::resource('categories', CategoryController::class);


    /*
    |--------------------------------------------------------------------------
    | MARKALAR
    |--------------------------------------------------------------------------
    */

    Route::resource('brands', BrandController::class);


    /*
    |--------------------------------------------------------------------------
    | ÜRÜNLER
    |--------------------------------------------------------------------------
    */

    Route::resource('products', ProductController::class);


    /*
    |--------------------------------------------------------------------------
    | RENKLER
    |--------------------------------------------------------------------------
    */

    Route::resource('colors', ColorController::class);


    /*
    |--------------------------------------------------------------------------
    | BEDENLER
    |--------------------------------------------------------------------------
    */

    Route::resource('sizes', SizeController::class);


    /*
    |--------------------------------------------------------------------------
    | ÜRÜN ÖZELLİKLERİ
    |--------------------------------------------------------------------------
    */

    Route::resource('product-attributes', ProductAttributeController::class);


    /*
    |--------------------------------------------------------------------------
    | SİPARİŞLER
    |--------------------------------------------------------------------------
    */

    Route::resource('orders', OrderController::class);


    /*
    |--------------------------------------------------------------------------
    | MÜŞTERİLER
    |--------------------------------------------------------------------------
    */

    Route::get('/customers', [CustomerController::class, 'index'])
        ->name('customers.index');

    Route::get('/customers/{customer}', [CustomerController::class, 'show'])
        ->name('customers.show');

    Route::delete('/customers/{customer}', [CustomerController::class, 'destroy'])
        ->name('customers.destroy');


    /*
    |--------------------------------------------------------------------------
    | TEKLİF TALEPLERİ
    |--------------------------------------------------------------------------
    */

    Route::resource('quote-requests', QuoteRequestController::class);


    /*
    |--------------------------------------------------------------------------
    | BANNERLAR
    |--------------------------------------------------------------------------
    */

    Route::resource('banners', BannerController::class);


    /*
    |--------------------------------------------------------------------------
    | AYARLAR
    |--------------------------------------------------------------------------
    */

    Route::get('/settings', [SettingController::class, 'index'])
        ->name('settings.index');

    Route::post('/settings', [SettingController::class, 'update'])
        ->name('settings.update');

});