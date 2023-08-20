<?php

namespace App\Http\Controllers\Api\System\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Provider\ApiCreateProviderRequest;
use App\Http\Requests\Api\Provider\ApiUpdateProviderRequest;
use App\Http\Resources\V1\Provider\ProviderCollection;
use App\Http\Resources\V1\Provider\ProviderResource;
use App\Models\Provider;
use App\Repositories\Api\System\V1\ProviderRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $this->providerRepo->setRelations(['city:id,name,name_mm', 'township:id,name,name_mm', 'provider_branches', 'provider_branches.city', 'provider_branches.township']);
    }
    public function index(Request $request)
    {
        $this->providerRepo->setFilters($request->all());
        $providers = $this->providerRepo->paginate();
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
        $provider = auth()->user()->created_providers()->create($request->all());
        return new ProviderResource($provider);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function show(Provider $provider)
    {
        return new ProviderResource($provider->load(['city', 'township', 'provider_branches', 'provider_branches.city', 'provider_branches.township']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function edit(Provider $provider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function update(Provider $provider, ApiUpdateProviderRequest $request)
    {
        $provider = $this->providerRepo->update($provider,$request->all());
        return new ProviderResource($provider);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $provider = Provider::find($id);
        $provider->delete();
        return response('Succefully Delete');
    }
}
