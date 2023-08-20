<?php

namespace App\Http\Controllers\Api\System\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Township\ApiCreateTownshipRequest;
use App\Http\Requests\Api\Township\ApiUpdateTownshipRequest;
use App\Http\Resources\V1\Township\TownshipCollection;
use App\Http\Resources\V1\Township\TownshipResource;
use App\Models\Township;
use App\Repositories\Api\System\V1\TownshipRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\CssSelector\Parser\Token;

class TownshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $townshipRepo;
    public function __construct(TownshipRepository $townshipRepo)
    {
        $this->townshipRepo = $townshipRepo;
        $this->townshipRepo->setRelations(['city:id,name,name_mm']);
    }
    public function index(Request $request)
    {  
        $this->townshipRepo->setFilters($request->all());
        $townships = $this->townshipRepo->paginate();
        return new TownshipCollection($townships);
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
    public function store(ApiCreateTownshipRequest $request)
    {
        $township = auth()->user()->created_townships()->create($request->all());
        return new TownshipResource($township);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Township $township)
    {
        return new TownshipResource($township);
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
    public function update(Township $township,ApiUpdateTownshipRequest $request)
    {
       $township = $this->townshipRepo->update($township,$request->all());
        return new TownshipResource($township);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Township::find($id)->delete();
        return response()->json(['status'=>1,'message'=>'Successfully deleted.']);
    }
}
