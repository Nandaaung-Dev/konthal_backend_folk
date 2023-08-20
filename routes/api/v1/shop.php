<?php

use App\Http\Controllers\Api\Shop\V1\Auth\ShopApiAuthController;
use App\Http\Controllers\Api\Shop\V1\HomeController;
use App\Http\Resources\V1\Owner\OwnerResource;
use Illuminate\Http\Request;
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

// Route::resource('/posts', PostController::class);
// Route::middleware('auth:owner-api')->get('/user', function (Request $request) {
//     return new OwnerResource($request->user());
// });
Route::post('/auth/login', [ShopApiAuthController::class, 'login'])->name('shop_api_login');
// Route::post('/sanctum/csrf-cookie', [ShopApiAuthController::class, 'login'])->name('shop_api_login');
Route::middleware('auth:owner-api')->group(function () {
    Route::get('dashboard', function () {
        return response()->json(['status' => 1, 'message' => 'access shop api']);
    });
    Route::get('/user', [ShopApiAuthController::class, 'me']);
});
Route::middleware('auth:owner-api')->group(function () {
    Route::resource('/cities', CityController::class, ['only' => ['index']]);
    Route::resource('/regions', RegionController::class, ['only' => ['index']]);
    Route::resource('/townships', TownshipController::class, ['only' => ['index']]);
    Route::resource('/departments', DepartmentController::class, ['only' => ['index']]);
    Route::resource('/payment_types', PaymentTypeController::class, ['only' => ['index']]);
    Route::resource('/providers', ProviderController::class);
    Route::resource('/provider_branches', ProviderBranchController::class);
    Route::resource('/shops', ShopController::class);
    Route::resource('/owners', OwnerController::class);
    Route::resource('/shoptypes', ShopTypeController::class);
    Route::resource('/payment_methods', PaymentMethodController::class);
    Route::resource('/branches', BranchController::class);
    Route::resource('/posts', PostController::class);
    Route::resource('/konthal_staffs', KonthalStaffController::class);
    // shopstaff route
    Route::resource('/shop_staffs', ShopStaffController::class);
    Route::resource('/shop_departments', ShopDepartmentController::class);
    Route::resource('/categories', CategoryController::class);
    Route::get('/initial_fetch', [HomeController::class, 'index']);
    Route::get('/auth/logout', [ShopApiAuthController::class, 'logout'])->name('shop_api_logout');
    Route::resource('/categories', CategoryController::class);
    Route::resource('/products', ProductController::class);
    Route::resource('/attributes', AttributeController::class);
});
