<?php

namespace App\Http\Controllers\Api\System\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ShopType\ShopTypeCollection;
use App\Http\Resources\V1\ShopType\ShopTypeResource;
use App\Models\ShopType;
use App\Repositories\Api\System\V1\ShopTypeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShopTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $shop_type_repo;
    public function __construct(ShopTypeRepository $shop_type_repo)
    {
        $this->shop_type_repo = $shop_type_repo;
        
    }
    public function index(Request $request)
    {  
        $this->shop_type_repo->setFilters($request->all());
        $shoptypes = $this->shop_type_repo->paginate();
        return new ShopTypeCollection($shoptypes);
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
    public function store(Request $request)
    {
        // $request->validate(['name' => 'required', 'name_mm' => 'required']);
        // $request->validate(
        //     ['name' => 'required', 'name_mm' => 'required'],
        //     ['name.required' => 'name is required', 'name_mm.required' => 'name_mm is required']
        // );
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:shop_types,name',
            'name_mm' => 'required',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'status' => 2,
                'errors' => $errors
            ], 422);
        }
        $shoptype = new ShopType();
        $shoptype->name = $request->name;
        $shoptype->name_mm = $request->name_mm;
        $shoptype->description = $request->description;
        $shoptype->save();
        return new ShopTypeResource($shoptype);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ShopType $shoptype)
    {
        //
        return new ShopTypeResource($shoptype);
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
    public function update(Request $request, $id)
    {
        $shoptype =ShopType::find($id);
        $shoptype->name = $request->name;
        $shoptype->name_mm = $request->name_mm;
        $shoptype->description = $request->description;
        $shoptype->save();
        return new ShopTypeResource($shoptype);
       //return response()->json(['status'=>'sucess']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shoptype = ShopType::find($id);
        $shoptype -> delete();
        return response()->json(['status'=>'1','Successfully deleted']);
    }
}
