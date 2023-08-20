<?php

namespace App\Http\Controllers\Api\Shop\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProviderBranch\ApiCreateProviderBranchRequest;
use App\Http\Requests\Api\ProviderBranch\ApiUpdateProviderBranchRequest;
use App\Http\Resources\V1\ProviderBranche\ProviderBrancheCollection;
use App\Http\Resources\V1\ProviderBranche\ProviderBrancheResource;
use App\Models\ProviderBranche;
use Illuminate\Http\Request;
use App\Repositories\Api\Shop\V1\ProviderBrancheRepository;

class ProviderBranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $provider_branchRepo;
    public function __construct(ProviderBrancheRepository $provider_branchRepo)
    {
        $this->provider_branchRepo = $provider_branchRepo;
        $this->provider_branchRepo->setRelations(['city:id,name,name_mm', 'township:id,name,name_mm','provider:name,name_mm']);
    }
    public function index(Request $request)
    {
        $this->provider_branchRepo->setFilters($request->all());
        $provider_branches = $this->provider_branchRepo->all();
        return new ProviderBrancheCollection($provider_branches);
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
    public function store(ApiCreateProviderBranchRequest $request)
    {
        $provider_branch = auth()->user()->created_provider_branches()->create($request->all());
        return new ProviderBrancheResource ($provider_branch->load(['city','township']));
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
    public function update(ProviderBranche $providerBranch, ApiUpdateProviderBranchRequest $request)
    {
        $provider_branch=$this->provider_branchRepo->update($providerBranch,$request->all());
        return new ProviderBrancheResource($provider_branch->load(['city','township']));
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
