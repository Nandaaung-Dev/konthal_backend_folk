<?php

namespace App\Http\Controllers\Api\System\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\City\ApiCreateCityRequest;
use App\Http\Requests\Api\City\ApiUpdateCityRequest;
use App\Http\Resources\V1\City\CityCollection;
use App\Http\Resources\V1\City\CityResource;
use App\Models\City;
use App\Repositories\Api\System\V1\CityRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $cityRepo;
    public function __construct(CityRepository $cityRepo)
    {
        $this->cityRepo = $cityRepo;
        $this->cityRepo->setRelations(['region:id,name,name_mm']);
    }
    public function index(Request $request)
    {
        // if ($request->has('paginate')) {
        //     $this->cityRepo->setPagination($request->get('paginate'));
        // }
        $this->cityRepo->setFilters($request->all());
        // $this->cityRepo->setSearch($request->get('search'));
        $cities = $this->cityRepo->paginate();
        // original using model
        // $cities = City::search($request->get('search'))->get();
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
    public function store(ApiCreateCityRequest $request)
    {
        $city = auth()->user()->created_cities()->create($request->all());
        return new CityResource($city);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        return new CityResource($city);
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
    public function update(City $city, ApiUpdateCityRequest $request)
    {
        $city = $this->cityRepo->update($city, $request->all());
        return new CityResource($city);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city = City::find($id);
        $city->delete();
        return response()->json(['status' => 1, 'message' => 'Successfully deleted.']);
    }
}
