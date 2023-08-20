<?php

namespace App\Http\Controllers\Api\System\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Region\ApiCreateRegionRequest;
use App\Http\Requests\Api\Region\ApiUpdateRegionRequest;
use App\Http\Resources\V1\Region\RegionCollection;
use App\Http\Resources\V1\Region\RegionResource;
use App\Models\Region;
use App\Repositories\Api\System\V1\RegionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $regionRepo;
    public function __construct(RegionRepository $regionRepo)
    {
        $this->regionRepo = $regionRepo;
    }
    public function index(Request $request)
    {
        $this->regionRepo->setFilters($request->all());
        $regions = $this->regionRepo->paginate();
        return new RegionCollection($regions);
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
    public function store(ApiCreateRegionRequest $request)
    {
        $region = auth()->user()->created_regions()->create($request->all());
        return new RegionResource($region);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Region $region)
    {
        return new RegionResource($region);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Region $region,ApiUpdateRegionRequest $request)
    {
        $region = $this->regionRepo->update($region,$request->all());
        return new RegionResource($region);
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
