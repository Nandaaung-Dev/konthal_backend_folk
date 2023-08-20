<?php

use App\Http\Controllers\Api\System\V1\Auth\SystemApiAuthController;
use App\Http\Controllers\Api\System\V1\CustomerController;
use App\Http\Controllers\Api\System\V1\HomeController;
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

Route::post('/auth/login', [SystemApiAuthController::class, 'login'])->name('system_api_login');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return response()->json(['status' => 1, 'data' => $request->user()]);
});
Route::middleware('auth:api')->group(function () {
    Route::get('/initial_fetch', [HomeController::class, 'index']);
    Route::resource('/posts', PostController::class);
    Route::apiResource('/regions', RegionController::class, ['as' => 'system']);
    Route::apiResource('/cities', CityController::class, ['as' => 'system']);
    Route::apiResource('/townships', TownshipController::class, ['as' => 'system']);
    // ShopType Routes
    Route::apiResource('/shoptypes', ShopTypeController::class, ['as' => 'system']);
    // Owner Routes
    Route::apiResource('/owners', OwnerController::class, ['as' => 'system']);
    // Shop Routes
    Route::apiResource('/shops', ShopController::class, ['as' => 'system']);
    // Branch Routes
    Route::apiResource('/branches', BranchController::class, ['as' => 'system']);
    // Department Routes
    Route::apiResource('/departments', DepartmentController::class, ['as' => 'system']);
    // Paymentmethod Routes
    Route::apiResource('/payment_methods', PaymentMethodController::class, ['as' => 'system']);
    // PaymentType Routes
    Route::apiResource('/payment_types', PaymentTypeController::class, ['as' => 'system']);
    // Provider Routes
    Route::apiResource('/providers', ProviderController::class, ['as' => 'system']);
    // ProviderBranch Routes
    Route::apiResource('/provider_branches', ProviderBranchController::class, ['as' => 'system']);
    // TypeRoutes
    Route::apiResource('/types', TypeController::class, ['as' => 'system']);
    // CategoryRoutes
    Route::apiResource('/categories', CategoryController::class, ['as' => 'system']);
    // ProductRoutes
    Route::apiResource('/products', ProductController::class, ['as' => 'system']);
    // BrandRoutes
    Route::apiResource('/brands', BrandController::class, ['as' => 'system']);
    Route::apiResource('/shop_staffs', ShopStaffController::class, ['as' => 'system']);
    Route::apiResource('/shop_departments', ShopDepartmentController::class, ['as' => 'system']);
    Route::apiResource('/customers', CustomerController::class, ['as' => 'system']);
    Route::apiResource('/addresses', AddressController::class, ['as' => 'system']);
    Route::apiResource('/log_statuses', LogStatusController::class, ['as' => 'system']);
});
