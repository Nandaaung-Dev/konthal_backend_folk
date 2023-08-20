<?php

namespace App\Http\Controllers\Api\Shop\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Provider\ApiCreateProviderRequest;
use App\Http\Requests\Api\Provider\ApiUpdateProviderRequest;
use App\Http\Resources\V1\Provider\ProviderCollection;
use App\Http\Resources\V1\Provider\ProviderResource;
use App\Models\Provider;
use Illuminate\Http\Request;
use App\Repositories\Api\Shop\V1\ProviderRepository;


class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $providerRepo;
    public function __construct(ProviderRepository $providerRepo)
    {
        $this->providerRepo = $providerRepo;
        $this->providerRepo->setRelations(['city:id,name,name_mm', 'township:id,name,name_mm']);
    }
    public function index(Request $request)
    {
        $this->providerRepo->setFilters($request->all());
        $providers = $this->providerRepo->all();
        return new ProviderCollection($providers);
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
    public function store(ApiCreateProviderRequest $request)
    {
        $provier = auth()->user()->created_providers()->create($request->all());
        return new ProviderResource($provier->load(['city','township']));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Provider $provider)
    {
        return new ProviderResource($provider->load(['city','township','provider_branches','provider_branches.city','provider_branches.township']));
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
    public function update( Provider $provider, ApiUpdateProviderRequest $request)
    {
        $provider=$this->providerRepo->update($provider,$request->all());
        return new ProviderResource($provider->load(['city','township']));
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
