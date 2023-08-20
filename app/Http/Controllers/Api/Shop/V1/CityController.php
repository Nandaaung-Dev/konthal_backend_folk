<?php

namespace App\Http\Controllers\Api\Shop\V1;

use App\Http\Resources\V1\City\CityCollection;
use App\Http\Resources\V1\City\CityResource;
use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use App\Repositories\Api\Shop\V1\CityRepository;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // private $cityRepo;
    public function __construct(CityRepository $cityRepo)
    {
        $this->cityRepo = $cityRepo;
        $this->cityRepo->setRelations(['region:id,name,name_mm']);
    }
    // public function index(Request $request)
    // {
    //     $this->cityRepo->setFilters($request->all());
    //     $cities = $this->cityRepo->paginate();
    //     return new CityCollection($cities);
    // }
    // public function index()
    // {
    //     $this->cityRepo = $cityRepo;
    //     $this->cityRepo->setRelations(['region:id,name,name_mm']);
    // }
    public function index(Request $request)
    {
        $this->cityRepo->setFilters($request->all());
        $cities = $this->cityRepo->all();
        return new CityCollection($cities);
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
