<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return 'Test Shop';
});
Route::namespace('App\Http\Controllers\Dashboard\Shop')->group(function () {
    Route::get('auth/login', function () {
        return Inertia::render('Shop/Auth/Login');
    })->name('shop_dashboard_login');
    Route::post('/auth/login', 'Auth\ShopAuthController@login')->name('shop_dashboard_post_login');
});

Route::namespace('App\Http\Controllers\Dashboard\Shop')->middleware(['auth:owner'])->group(function () {
    Route::resource('/dashboard', DashboardController::class, ['as' => 'shop_dashboard']);
    // general 
    Route::resource('/regions', RegionController::class, ['as' => 'shop_dashboard']);
    Route::resource('/cities', CityController::class, ['as' => 'shop_dashboard']);
    Route::resource('/townships', TownshipController::class, ['as' => 'shop_dashboard']);
    Route::resource('/departments', DepartmentController::class, ['as' => 'shop_dashboard']);
    Route::resource('/payment_types', PaymentTypeController::class, ['as' => 'shop_dashboard']);
    // 
    Route::resource('providers', ProviderController::class, ['as' => 'shop_dashboard']);

    // Route::resource('/provider_branches', ProviderBranchController::class, ['as' => 'shop_dashboard']);
    // Route::resource('/shops', ShopController::class, ['as' => 'shop_dashboard']);
    // Route::resource('/owners', OwnerController::class, ['as' => 'shop_dashboard']);
    // Route::resource('/shoptypes', ShopTypeController::class, ['as' => 'shop_dashboard']);
    // Route::resource('/payment_methods', PaymentMethodController::class, ['as' => 'shop_dashboard']);
    // Route::resource('/branches', BranchController::class, ['as' => 'shop_dashboard']);
    // Route::resource('/posts', PostController::class, ['as' => 'shop_dashboard']);
});
