<?php

namespace App\Http\Controllers\Api\Shop\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Attribute\AttributeCollection;
use App\Http\Resources\V1\AttributeValue\AttributeValueCollection;
use App\Http\Resources\V1\Brand\BrandCollection;
use App\Http\Resources\V1\Category\CategoryCollection;
use App\Http\Resources\V1\Category\CategoryResource;
use App\Http\Resources\V1\MainCategory\MainCategoryCollection;
use App\Http\Resources\V1\Product\ProductCollection;
use App\Http\Resources\V1\Product\ProductResource;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Brand;
use App\Models\Category;
use App\Models\MainCategory;
use App\Models\Product;
use App\Repositories\Api\Shop\V1\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $productRepo;
    public function __construct(ProductRepository $productRepo)
    {
        $this->productRepo = $productRepo;
        $this->productRepo->setRelations(['shop:id,name', 'brand:id,name']);
    }
    public function index(Request $request)
    {
        $this->productRepo->setFilters($request->all());
        $products = $this->productRepo->all();
        return new ProductCollection($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $main_categories = MainCategory::all();
        $categories = Category::all();
        $brands = Brand::all();
        return response()->json(['data' => [
            'main_categories' => new MainCategoryCollection($main_categories),
            'categories' => new CategoryCollection($categories),
            'brands' => new BrandCollection($brands)
        ], 'status' => 1]);
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
    public function show(Product $product)
    {
        return new ProductResource($product->load(['branch', 'brand', 'main_category']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $main_categories = MainCategory::all();
        $categories = Category::all();
        $brands = Brand::all();
        $attributes = Attribute::with('attribute_values')->get();
        // return new ProductResource($product);
        return response()->json(['data' => [
            'product' => new ProductResource($product->load(['product_attributes'])),
            'main_categories' => new MainCategoryCollection($main_categories),
            'categories' => new CategoryCollection($categories),
            'brands' => new BrandCollection($brands),
            'attributes' => new AttributeCollection($attributes)
        ], 'status' => 1]);
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
