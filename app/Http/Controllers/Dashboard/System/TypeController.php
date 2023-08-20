<?php

namespace App\Http\Controllers\Dashboard\System;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Type\CreateTypeRequest;
use App\Http\Requests\Dashboard\Type\UpdateTypeRequest;
use App\Models\Type;
use App\Repositories\Api\System\V1\TypeRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;


class TypeController extends Controller
{
    public $typeRepo;
    public function __construct(TypeRepository $typeRepo)
    {
        $this->middleware('role:system_super_admin', ['except' => ['index', 'show']]);
        $this->middleware('permission:types-create', ['only' => 'create', 'store']);
        $this->middleware('permission:types-edit', ['only' => 'edit', 'update']);
        $this->typeRepo = $typeRepo;
        $this->typeRepo->setPagination(5);
    }

    public function index()
    {
        $types = $this->typeRepo->paginate();
        return Inertia::render('Types/Index', [

            'can' => [
                'create' => auth()->user()->can('types-create'),
                'edit' => auth()->user()->can('types-edit'),
                'delete' => auth()->user()->can('types-delete')
            ],
            'role' => [
                'system_super_admin' => auth()->user()->hasRole('system_super_admin')
            ],
            'resource_name' => 'types',
            'deletable' => false,
            'types' => $types

        ]);
    }
    public function create()
    {

        
        return Inertia::render('Types/CreateTypeForm');
        
    }
    public function store(CreateTypeRequest $request)
    {  
        $request['slug']=Str::of($request->name)->slug('-');
       $this->typeRepo->create($request->all());
        return redirect()->route('system_dashboard.types.index')->with('message', 'Type was created!');
    }
    public function edit(Type $type)
    {

        
        return Inertia::render('Types/EditTypeForm',['type'=>$type]);
    
    }
    public function update(Type $type, UpdateTypeRequest $request)
    {
       $this->typeRepo->update($type,$request->all());
        return redirect()->route('system_dashboard.types.index')->with('message', 'Type was updated.');
    }
    public function destroy(Type $type)
    {
        $type->delete();
        return redirect()->route('system_dashboard.types.index')->with('message', 'Type was deleted.');
    }
}
