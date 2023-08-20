<?php

namespace App\Http\Controllers\Api\Shop\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Brand\BrandCollection;
use App\Http\Resources\V1\Category\CategoryCollection;
use App\Http\Resources\V1\MainCategory\MainCategoryCollection;
use App\Http\Resources\V1\City\CityCollection;
use App\Http\Resources\V1\ProductCategory\ProductCategoryCollection;
use App\Http\Resources\V1\Region\RegionCollection;
use App\Http\Resources\V1\Shop\ShopCollection;
use App\Http\Resources\V1\ShopType\ShopTypeCollection;
use App\Http\Resources\V1\Township\TownshipCollection;
use App\Models\Brand;
use App\Models\Category;
use App\Models\City;
use App\Models\MainCategory;
use App\Models\ProductCategory;
use App\Models\Region;
use App\Models\Shop;
use App\Models\ShopType;
use App\Models\Township;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regions = Region::orderBy('name')->get();
        $cities = City::orderBy('name')->get();
        $townships = Township::orderBy('name')->get();
        $shops = Shop::orderBy('name')->get();
        $shop_types = ShopType::orderBy('name')->get();
        $main_categories = MainCategory::orderBy('name')->get();
        $product_categories = ProductCategory::orderBy('name')->get();
        $brands = Brand::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();
        return response()->json(['status' => 1, 'data' => [
            'regions' => new RegionCollection($regions),
            'cities' => new CityCollection($cities),
            'townships' => new TownshipCollection($townships),
            'shops' => new ShopCollection($shops),
            'shop_types' => new ShopTypeCollection($shop_types),
            'main_categories' => new MainCategoryCollection($main_categories),
            'product_categories' => new ProductCategoryCollection($product_categories),
            'brands' => new BrandCollection($brands),
            'categories' => new CategoryCollection($categories),
        ]]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
