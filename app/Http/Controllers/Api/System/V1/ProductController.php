<?php

namespace App\Http\Controllers\Api\System\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Product\ApiCreateProductRequest;
use App\Http\Requests\Api\Product\ApiUpdateProductRequest;
use App\Http\Requests\Api\Shop\ApiCreateShopRequest;
use App\Http\Resources\V1\Product\ProductCollection;
use App\Http\Resources\V1\Product\ProductResource;
use App\Models\Product;
use App\Models\Shop;
use App\Repositories\Api\System\V1\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


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
        $this->productRepo->setRelations(['shop:id,name', 'branch:id,name,name_mm', 'category:id,name,name_mm', 'brand:id,name,name_mm']);
    }
    public function index(Request $request)
    {
        $this->productRepo->setFilters($request->all());
        $products = $this->productRepo->paginate();
        return new ProductCollection($products);
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
    public function store(ApiCreateProductRequest $request)
    {
        $slug = Str::of($request->name)->slug('-');
        $request->merge(['slug' => $slug]);
        $product = auth()->user()->created_products()->create($request->all());
        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return new ProductResource($product->load(['shop', 'category', 'branch', 'brand']));
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
    public function update(Product $product,ApiUpdateProductRequest $request)
    {   
        $product = $this->productRepo->update($product,$request->all());
        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return response()->json(['status' => 1, 'message' => 'Successfully deleted.']);
    }
}
