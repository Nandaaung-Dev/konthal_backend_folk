<?php

namespace App\Http\Controllers\Api\Shop\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Attribute\AttributeCollection;
use App\Http\Resources\V1\Attribute\AttributeResource;
use App\Http\Resources\V1\Shop\ShopCollection;
use App\Models\Shop;
use App\Repositories\Api\Shop\V1\AttributeRepository;
use App\Models\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $attriRepo;
    public function __construct(AttributeRepository $attriRepo)
    {
        $this->attriRepo = $attriRepo;
        $this->attriRepo->setRelations(['shop:id,name']);
    }
    public function index(Request $request)
    {
        $this->attriRepo->setFilters($request->all());
        $attributes = $this->attriRepo->all();
        return new AttributeCollection($attributes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shops = Shop::all();
        return response()->json(['data'=>['shops'=> new ShopCollection('shops')],'status'=>1]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Attribute $attribute)
    {
        return new AttributeResource($attribute->load(['shop']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Attribute $attribute)
    {
        $shops = Shop::all();
        return response()->json(['data'=>
          [  'attribute' => new AttributeResource($attribute->load(['attribute_values'])),
            'shops'=> new ShopCollection($shops)],
          'status'=>1]);
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
        //
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
