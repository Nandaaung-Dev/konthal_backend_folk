<?php

namespace App\Http\Controllers\Api\System\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Department\ApiCreateDepartmentRequest;
use App\Http\Requests\Api\Department\ApiUpdateDepartmentRequest;
use App\Http\Resources\V1\Department\DepartmentCollection;
use App\Http\Resources\V1\Department\DepartmentResource;
use App\Models\Department;
use App\Repositories\Api\System\V1\DepartmentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $departmentRepo;
    public function __construct(DepartmentRepository $departmentRepo)
    {
        $this->departmentRepo = $departmentRepo;
        
    }
    public function index(Request $request)
    {  
        $this->departmentRepo->setFilters($request->all());
        $departments = $this->departmentRepo->paginate();
        return new DepartmentCollection($departments);
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
    public function store(ApiCreateDepartmentRequest $request)
    {
        $department = auth()->user()->created_departments()->create($request->all());
        return new DepartmentResource($department);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        return new DepartmentResource($department);
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
    public function update(Department $department, ApiUpdateDepartmentRequest $request)
    {
        $department = $this->departmentRepo->update($department,$request->all());
        return new DepartmentResource($department);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $department=Department::find($id);
        $department->delete();
        return response()->json(['status'=>'1','successfully deleted']);
    }
}
