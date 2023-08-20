<?php

namespace App\Http\Controllers\Api\System\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Branch\ApiCreateBranchRequest;
use App\Http\Requests\Api\Branch\ApiUpdateBranchRequest;
use App\Http\Resources\V1\Branch\BranchCollection;
use App\Http\Resources\V1\Branch\BranchResource;
use App\Models\Branch;
use App\Repositories\Api\System\V1\BranchRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
        $this->branchRepo->setRelations(['shop:id,name,name_mm', 'shop_type:id,name,name_mm', 'city:id,name,name_mm', 'township:id,name,name_mm']);
    }
    public function index(Request $request)
    {
        $this->branchRepo->setFilters($request->all());
        $branches = $this->branchRepo->paginate();
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


        // $branch = new Branch();
        // $branch->name = $request->name;
        // $branch->name_mm = $request->name_mm;
        // $branch->phone_number = $request->phone_number;
        // $branch->address = $request->address;
        // $branch->description = $request->description;
        // $branch->shop_id = $request->shop_id;
        // $branch->shop_type_id = $request->shop_type_id;
        // $branch->city_id = $request->city_id;
        // $branch->township_id = $request->township_id;
        // $branch->save();
        $slug = Str::of($request->name)->slug('-');
        $request->merge(['slug' => $slug]);
        $branch = auth()->user()->created_branches()->create($request->all());
        return new BranchResource($branch);
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
        $branch = $this->branchRepo->update($branch,$request->all());
        return new BranchResource($branch);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $branch = Branch::find($id);
        $branch->delete();
        return response()->json(['status' => 1, 'message' => 'Successfully deleted.']);
    }
}
