<?php

use App\Http\Controllers\Dashboard\System\TypeController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:web', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});


Route::namespace('App\Http\Controllers\Dashboard\System')->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',

])->group(function () {
    Route::resource('posts', PostController::class, ['as' => 'system_dashboard']);
    // regions route
    Route::resource('regions', RegionController::class, ['as' => 'system_dashboard']);
    // cities route
    Route::resource('cities', CityController::class, ['as' => 'system_dashboard']);
    // department route
    Route::resource('departments', DepartmentController::class, ['as' => 'system_dashboard']);
    // payment method route
    Route::resource('payment_methods', PaymentMethodController::class, ['as' => 'system_dashboard']);
    // payment type route
    Route::resource('payment_types', PaymentTypeController::class, ['as' => 'system_dashboard']);
    //Providers route
    Route::resource('providers', ProviderController::class, ['as' => 'system_dashboard']);
    //Providers route
    Route::resource('provider_branches', ProviderBranchController::class, ['as' => 'system_dashboard']);
    //shoptypes route
    Route::resource('shop_types', ShopTypeController::class, ['as' => 'system_dashboard']);
    //owners route
    Route::resource('owners', OwnerController::class, ['as' => 'system_dashboard']);
    // shops route
    Route::resource('shops', ShopController::class, ['as' => 'system_dashboard']);
    // branches route
    Route::resource('branches', BranchController::class, ['as' => 'system_dashboard']);
    // townships route
    Route::resource('townships', TownshipController::class, ['as' => 'system_dashboard']);

    //types route
    Route::resource('types', TypeController::class, ['as' => 'system_dashboard']);
    //category route
    Route::resource('categories', CategoryController::class, ['as' => 'system_dashboard']);
});
Route::post('auth/login', function () {
    return "Auth";
});
