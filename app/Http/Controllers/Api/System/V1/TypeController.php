<?php

namespace App\Http\Controllers\Api\System\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Type\TypeCollection;
use App\Http\Resources\V1\Type\TypeResource;
use App\Models\Type;
use App\Repositories\Api\System\V1\TypeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $typeRepo;
    public function __construct(TypeRepository $typeRepo)
    {
        $this->typeRepo = $typeRepo;
        
    }
    public function index(Request $request)
    {  
        $this->typeRepo->setFilters($request->all());
        $types = $this->typeRepo->paginate();
        return new TypeCollection($types);
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:types,name',
            'name_mm' => 'required',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'status' => 2,
                'errors' => $errors
            ], 422);
        }
        $type=new Type();
        $type->name=$request->name;
        $type->name_mm=$request->name_mm;
        $type->save();
        return new TypeResource($type);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        return new TypeResource($type);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        $type=Type::find($id);
        $type->name=$request->name;
        $type->name_mm=$request->name_mm;
        $type->save();
        return new TypeResource($type);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Type::find($id)->delete();
        return response()->json(['status'=>'1','successfully deleted']);
    }
}
