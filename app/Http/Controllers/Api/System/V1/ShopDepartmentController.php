<?php

namespace App\Http\Controllers\Api\System\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ShopDepartment\ShopDepartmentCollection;
use App\Repositories\Api\System\V1\ShopDepartmentRepository;
use Illuminate\Http\Request;

class ShopDepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $shop_departmentRepo;
    public function __construct(ShopDepartmentRepository $shop_departmentRepo)
    {
        $this->shop_departmentRepo = $shop_departmentRepo;
        $this->shop_departmentRepo->setRelations(['shop:id,name,name_mm']);
    }
    public function index(Request $request)
    {
        $this->shop_departmentRepo->setFilters($request->all());
        $shop_departments = $this->shop_departmentRepo->all();
        return new ShopDepartmentCollection($shop_departments);
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
