<?php

namespace App\Http\Controllers\Api\Shop\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Shop\UpdateShopRequest;
use App\Http\Resources\V1\Shop\ShopCollection;
use App\Http\Resources\V1\Shop\ShopResource;
use App\Models\Shop;
use App\Repositories\Api\Shop\V1\ShopRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // private $shopRepo;
    // public function __construct(ShopRepository $shopRepo)
    // {
    //     $this->shopRepo = $shopRepo;
    // }
    // public function index(Request $request)
    // {
    //     $this->shopRepo->setFilters($request->all());
    //     $shops = $this->shopRepo->paginate();
    //     return new ShopCollection($shops);
    // }

    // public function index()
    // {
    //     $this->shopRepo = $shopRepo;
    //     $this->shopRepo->setRelations(['city:id,name,name_mm', 'township:id,name,name_mm', 'shop_type:id,name']);
    // }
    public function index(Request $request)
    {
        $this->shopRepo->setFilters($request->all());
        $shops = $this->shopRepo->all();
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
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => ' required|unique:shops,name',
                'name_mm' => ' required',


            ]
        );
        if ($validator->fails()) {
            return response()->json(['status' => 2, 'message' => $validator->errors()]);
        }
        $shop = new Shop();
        $shop->name = $request->name;
        $shop->name_mm = $request->name_mm;
        $shop->save();
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
        return new ShopResource($shop->load(['owner', 'shop_type', 'city', 'township', 'categories', 'branches', 'branches.city', 'branches.township']));
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
    public function update(Shop $shop, UpdateShopRequest $request)
    {
        $shop = $this->shopRepo->update($shop, $request->all());
        return new ShopResource($shop->load(['owner', 'shop_type', 'city', 'township']));
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
