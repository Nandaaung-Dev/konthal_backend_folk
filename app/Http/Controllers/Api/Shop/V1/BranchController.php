<?php

namespace App\Http\Controllers\Api\Shop\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Branch\ApiCreateBranchRequest;
use App\Http\Requests\Api\Branch\ApiUpdateBranchRequest;
use App\Http\Requests\Dashboard\Branch\UpdateBranchRequest;
use App\Http\Resources\V1\Branch\BranchCollection;
use App\Http\Resources\V1\Branch\BranchResource;
use App\Models\Branch;
use App\Repositories\Api\Shop\V1\BranchRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $branchRepo;
    public function __construct(BranchRepository $branchRepo)
    {
        $this->branchRepo = $branchRepo;
        $this->branchRepo->setRelations(['city:id,name,name_mm', 'township:id,name,name_mm', 'shop:id,name', 'shop_type:id,name']);
    }
    public function index(Request $request)
    {
        $this->branchRepo->setFilters($request->all());
        $branches = $this->branchRepo->all();
        return new BranchCollection($branches);
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
    public function store(ApiCreateBranchRequest $request)
    {
        $slug = Str::of($request->name)->slug('-');
        $request->merge(['slug' => $slug]);
        $branch = auth()->user()->created_branches()->create($request->all());
        // $branch = $this->branchRepo->create($request->all());
        return new BranchResource($branch->load(['city', 'township']));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {
        return new BranchResource($branch);
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
    public function update(Branch $branch, ApiUpdateBranchRequest $request)
    {
        // $updatable_id = auth()->user()->id;
        // $updatable_type = class_basename(auth()->user());
        // $request->merge(['updatable_id' => $updatable_id, 'updatable_type', $updatable_type]);
        $branch = $this->branchRepo->update($branch, $request->all());
        return new BranchResource($branch->load(['city', 'township']));
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
