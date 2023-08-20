<?php

namespace App\Http\Controllers\Dashboard\System;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Region\CreateRegionRequest;
use App\Http\Requests\Dashboard\Region\UpdateRegionRequest;
use App\Models\Region;
use App\Repositories\Api\System\V1\RegionRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RegionController extends Controller
{
    public $regionRepo;
    public function __construct(RegionRepository $regionRepo)
    {
        // $this->middleware('role:system_super_admin', ['only' => ['create', 'store', 'edit', 'delete']]);
        $this->middleware('role:system_super_admin', ['except' => ['index', 'show']]);
        $this->middleware('permission:regions-create', ['only' => 'create', 'store']);
        $this->middleware('permission:regions-edit', ['only' => 'edit', 'update']);
        $this->regionRepo = $regionRepo;
        $this->regionRepo->setPagination(3);
    }
    public function index()
    {
        // $regions = Region::paginate(10);
        $regions = $this->regionRepo->paginate();
        return Inertia::render('Regions/Index', [
            'can' => [
                'create' => auth()->user()->can('regions-create'),
                'edit' => auth()->user()->can('regions-edit'),
                'delete' => auth()->user()->can('regions-delete'),
            ],
            'role' => [
                'system_super_admin' => auth()->user()->hasRole('system_super_admin'),
            ],
            'resource_name' => 'regions',
            'deletable' => false,
            'regions' => $regions
        ]);
    }
    public function create()
    {
        return Inertia::render('Regions/CreateRegionForm');
    }
    public function store(CreateRegionRequest $request)
    {
        $this->regionRepo->create($request->all());
        return redirect()->route('system_dashboard.regions.index')->with('message', 'Region was created!');
    }
    public function edit(Region $region)
    {
        return Inertia::render('Regions/EditRegionForm', ['region' => $region]);
    }
    public function update(Region $region,UpdateRegionRequest $request)
    {
        $this->regionRepo->update($region,$request->all());
        return redirect()->route('system_dashboard.regions.index')->with('message', 'Region was updated.');
    }
    public function destroy(Region $region)
    {
        $region->delete();
        return redirect()->route('system_dashboard.regions.index')->with('message', 'Region was deleted.');
    }
}
