<?php

namespace App\Http\Controllers\Dashboard\System;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Owner\CreateOwnerRequest;
use App\Http\Requests\Dashboard\Owner\UpdateOwnerRequest;
use App\Models\City;
use App\Models\Owner;
use App\Models\Township;
use App\Repositories\Dashboard\System\OwnerRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OwnerController extends Controller
{

    public $ownerRepo;
    public function __construct(OwnerRepository $ownerRepo)
    {
        // $this->middleware('role:system_super_admin',['only'=> ['create','store','edit','delete']]);
        $this->middleware('role:system_super_admin', ['except' => ['index', 'show']]);
        $this->middleware('permission:owners-create', ['only' => 'create', 'store']);
        $this->middleware('permission:owners-edit', ['only' => 'edit', 'update']);
        $this->ownerRepo = $ownerRepo;
        $this->ownerRepo->setPagination(5);
        $this->ownerRepo->setRelations(['city', 'township']);
    }

    public function index()
    {
        $owners = $this->ownerRepo->paginate();
        return Inertia::render('Owners/Index', [
            'can' => [
                'create' => auth()->user()->can('owners-create'),
                'edit' => auth()->user()->can('owners-edit'),
                'delete' => auth()->user()->can('owners-delete')
            ],

            'role' => [
                'system_super_admin' => auth()->user()->hasRole('system_super_admin'),
            ],
            'resource_name' => 'owners',
            'deletable' => false,
            'owners' => $owners
        ]);
    }
    public function create()
    {
        $cities = City::all();
        $townships = Township::all();
        return Inertia::render('Owners/CreateOwnerForm', ['cities' => $cities, 'townships' => $townships]);
    }
    public function store(CreateOwnerRequest $request)
    {
        $this->ownerRepo->create($request->all());
        return redirect()->route('system_dashboard.owners.index')->with('message', 'Owner was created!');
    }
    public function edit(Owner $owner)
    {
        $cities = City::all();
        $townships = Township::all();
        return Inertia::render('Owners/EditOwnerForm', ['owner' => $owner, 'cities' => $cities, 'townships' => $townships]);
    }
    public function update(Owner $owner, UpdateOwnerRequest $request)
    {
        $this->ownerRepo->update($owner, $request->all());
        return redirect()->route('system_dashboard.owners.index')->with('message', 'Owner was updated!');
    }
    public function destory(Owner $owner)
    {
        $owner->delete();
        return redirect()->route('system_dashboard.owners.index')->with('message', 'Owner was deleted!');
    }
}
