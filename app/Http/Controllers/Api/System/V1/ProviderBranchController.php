<?php

namespace App\Http\Controllers\Api\System\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProviderBranch\ApiCreateProviderBranchRequest;
use App\Http\Requests\Api\ProviderBranch\ApiUpdateProviderBranchRequest;
use App\Http\Resources\V1\ProviderBranche\ProviderBrancheCollection;
use App\Http\Resources\V1\ProviderBranche\ProviderBrancheResource;
use App\Models\ProviderBranche;
use App\Repositories\Api\System\V1\ProviderRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProviderBranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $providerBranchRepo;
    public function __construct(ProviderRepository $providerBranchRepo)
    {
        $this->providerBranchRepo = $providerBranchRepo;
        $this->providerBranchRepo->setRelations(['city:id,name,name_mm', 'township:id,name,name_mm', 'provider:name,name_mm']);
    }
    public function index(Request $request)
    {
        $this->providerBranchRepo->setFilters($request->all());
        $providerBranches = $this->providerBranchRepo->paginate();
        return new ProviderBrancheCollection($providerBranches);
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
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required|unique:provider_branches,name',
        //     'email' => 'required',
        // ]);
        // if ($validator->fails()) {
        //     $errors = $validator->errors();
        //     return response()->json([
        //         'status' => 2,
        //         'errors' => $errors
        //     ], 422);
        // }
        // $providerBranche = new ProviderBranche();
        // $providerBranche->name = $request->name;
        // $providerBranche->email = $request->email;
        // $providerBranche->phone = $request->phone;
        // $providerBranche->address = $request->address;
        // $providerBranche->city_id = $request->city_id;
        // $providerBranche->township_id = $request->township_id;
        // $providerBranche->provider_id = $request->provider_id;
        // $providerBranche->save();
        // return new ProviderBrancheResource($providerBranche);
        $providerBranches = auth()->user()->created_provider_branches()->create($request->all());
        return new ProviderBrancheResource($providerBranches);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ProviderBranche $providerBranche)
    {
        return new ProviderBrancheResource($providerBranche);
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
        $providerBranch = $this->providerBranchRepo->update($providerBranch,$request->all());
        return new ProviderBrancheResource($providerBranch);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $providerBranche = ProviderBranche::find($id);
        $providerBranche->delete();
        return response('Succefully Delete');
    }
}
