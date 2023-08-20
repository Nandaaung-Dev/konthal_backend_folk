<?php

namespace App\Http\Controllers\Api\Shop\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ShopStaff\ShopStaffCollection;
use App\Models\ShopStaff;
use App\Repositories\Api\Shop\V1\ShopStaffRepository;
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
        $this->shopStaffRepo->setRelations(['city:id,name,name_mm', 'township:id,name,name_mm', 'shop:id,name,name_mm','branch:id,name,name_mm','department:id,name,name_mm']);
    }
    public function index(Request $request)
    {
        $this->shopStaffRepo->setFilters($request->all());
        $shopStaffs= $this->shopStaffRepo->all();
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
