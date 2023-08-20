<?php

namespace App\Http\Controllers\Api\System\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ShopStaff\ApiCreateShopStaffRequest;
use App\Http\Requests\Api\ShopStaff\ApiUpdateShopStaffRequest;
use App\Http\Resources\V1\ShopStaff\ShopStaffCollection;
use App\Http\Resources\V1\ShopStaff\ShopStaffResource;
use App\Models\ShopStaff;
use App\Repositories\Api\System\V1\ShopStaffRepository;
use Illuminate\Http\Request;

class ShopStaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $shopStaffRepo;
    public function __construct(ShopStaffRepository $shopStaffRepo)
    {
        $this->shopStaffRepo = $shopStaffRepo;
        $this->shopStaffRepo->setRelations(['city:id,name,name_mm', 'township:id,name,name_mm', 'shop:id,name,name_mm', 'branch:id,name,name_mm', 'department:id,name,name_mm']);
    }
    public function index(Request $request)
    {
        $this->shopStaffRepo->setFilters($request->all());
        $shopStaffs = $this->shopStaffRepo->all();
        return new ShopStaffCollection($shopStaffs);
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
    public function store(ApiCreateShopStaffRequest $request)
    {
        $shop_staff = auth()->user()->created_shop_staffs()->create($request->all());
        return new ShopStaffResource($shop_staff);
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
    public function update(ShopStaff $shop_staff, ApiUpdateShopStaffRequest $request)
    {
        $shop_staff=$this->shopStaffRepo->update($shop_staff,$request->all());
        return new ShopStaffResource($shop_staff);
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
