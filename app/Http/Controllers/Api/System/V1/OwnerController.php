<?php

namespace App\Http\Controllers\Api\System\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Owner\ApiCreateOwnerRequest;
use App\Http\Requests\Api\Owner\ApiUpdateOwnerRequest;
use App\Http\Resources\V1\Owner\OwnerCollection;
use App\Http\Resources\V1\Owner\OwnerResource;
use App\Models\Owner;
use App\Repositories\Api\System\V1\OwnerRepository;
use Illuminate\Http\Request;


class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $ownerRepo;
    public function __construct(OwnerRepository $ownerRepo)
    {
        $this->ownerRepo = $ownerRepo;
        $this->ownerRepo->setRelations(['city:id,name,name_mm','township:id,name,name_mm']);
    }
    public function index(Request $request)
    {
        $this->ownerRepo->setFilters($request->all());
        $owners = $this->ownerRepo->paginate();
        return new OwnerCollection($owners);
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
    public function store(ApiCreateOwnerRequest $request)
    {

        $owner = auth()->user()->created_owners()->create($request->all());
        return new OwnerResource($owner);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Owner $owner)
    {
        return new OwnerResource($owner);
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
    public function update(Owner $owner,ApiUpdateOwnerRequest $request)
    {
        $owner = $this->ownerRepo->update($owner,$request->all());
        return new OwnerResource($owner);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $owner = Owner::find($id);
        $owner->delete();
        return response()->json(['status' => '1', 'Sucessfully Deleted']);
    }
}
