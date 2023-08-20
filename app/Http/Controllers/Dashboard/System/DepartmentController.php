<?php

namespace App\Http\Controllers\Dashboard\System;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Department\CreateDepartmentRequest;
use App\Http\Requests\Dashboard\Department\UpdateDepartmentRequest;
use App\Models\Department;
use App\Repositories\Api\Shop\V1\DepartmentRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DepartmentController extends Controller
{
    public $departRepo;
    public function __construct(DepartmentRepository $departRepo)
    {
        $this->middleware('role:system_super_admin', ['except' => ['index', 'show']]);
        $this->middleware('permission:departments-create', ['only' => 'create', 'store']);
        $this->middleware('permission:departments-edit', ['only' => 'edit', 'update']);
        $this->departRepo = $departRepo;
        $this->departRepo->setPagination(10);
    }
    public function index()
    {

        $departments = $this->departRepo->paginate();
        return Inertia::render('Departments/Index', [
            'can' => [
                'create' => auth()->user()->can('departments-create'),
                'edit' => auth()->user()->can('departments-edit'),
                'delete' => auth()->user()->can('departments-delete'),
            ],
            'role' => [
                'system_super_admin' => auth()->user()->hasROle('system_super_admin'),
            ],
            'resource_name' => 'departments',
            'deletable' => false,
            'departments' => $departments
        ]);
    }
    public function create()
    {
        return Inertia::render('Departments/CreateDepartmentForm');
    }
    public function store(CreateDepartmentRequest $request)
    {
        $this->departRepo->create($request->all());
        return redirect()->route('system_dashboard.departments.index')->with('message', 'department was created!');
    }
    public function Edit(Department $department)
    {
        return Inertia::render('Departments/EditDepartmentForm', ['department' => $department]);
    }
    public function update(Department $department, UpdateDepartmentRequest $request)
    {
        $this->departRepo->update($department, $request->all());
        return redirect()->route('system_dashboard.departments.index')->with('message', 'department was updated.');
    }
    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('system_dashboard.departments.index')->with('message', 'department was deleted.');
    }
}
