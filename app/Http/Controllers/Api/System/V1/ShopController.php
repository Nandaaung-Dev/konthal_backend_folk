<?php

namespace App\Http\Controllers\Api\System\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Shop\ApiCreateShopRequest;
use App\Http\Requests\Api\Shop\ApiUpdateShopRequest;
use App\Http\Resources\V1\Shop\ShopCollection;
use App\Http\Resources\V1\Shop\ShopResource;
use App\Models\Shop;
use App\Repositories\Api\System\V1\ShopRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $shopRepo;
    public function __construct(ShopRepository $shopRepo)
    {
        $this->shopRepo = $shopRepo;
        $this->shopRepo->setRelations(['owner:id,name', 'city:id,name,name_mm', 'township:id,name,name_mm', 'shop_type:id,name,name_mm']);
    }
    public function index(Request $request)
    {
        $this->shopRepo->setFilters($request->all());
        $shops = $this->shopRepo->paginate();
        return new ShopCollection($shops);
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
    public function store(ApiCreateShopRequest $request)
    {
        $slug = Str::of($request->name)->slug('-');
        $request->merge(['slug' => $slug]);
        $shop = auth()->user()->created_shops()->create($request->all());
        return new ShopResource($shop);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        return new ShopResource($shop->load(['owner', 'shop_type', 'city', 'township', 'products', 'products.category', 'products.brand','products.branch', 'branches', 'branches.city', 'branches.township', 'shop_staffs', 'shop_staffs.city', 'shop_staffs.township', 
    'shop_staffs.shop_department','shop_staffs.branch']));
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
    public function update(Shop $shop, ApiUpdateShopRequest $request)
    {
        $shop = $this->shopRepo->update($shop,$request->all());
        return new ShopResource($shop);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shop = Shop::find($id);
        $shop->delete();
        return response()->json(['status' => 1, 'message' => 'Successfully deleted.']);
    }
}
