<?php

namespace App\Http\Controllers\Dashboard\System;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ProviderBranch\CreateProviderBranchRequest;
use App\Http\Requests\Dashboard\ProviderBranch\UpdateProviderBranchRequest;
use App\Models\City;
use App\Models\Provider;
use App\Models\ProviderBranche;
use App\Models\Township;
use App\Repositories\Dashboard\System\ProviderBranchRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProviderBranchController extends Controller
{
    public $providerBranchRepo;
    public function __construct(ProviderBranchRepository $providerBranchRepo)
    {
        // $this->middleware('role:system_super_admin', ['only' => ['create', 'store', 'edit', 'delete']]);
        $this->middleware('role:system_super_admin', ['except' => ['index', 'show']]);
        $this->middleware('permission:provider_branches-create', ['only' => 'create', 'store']);
        $this->middleware('permission:provider_branches-edit', ['only' => 'edit', 'update']);
        $this->providerBranchRepo= $providerBranchRepo;
        $this->providerBranchRepo->setPagination(2);
        $this->providerBranchRepo->setRelations(['city','township','provider']);
    }
    public function index()
    {
        $provider_branches = $this->providerBranchRepo->paginate();
        // $provider_branches = ProviderBranche::with("city", "township", "provider")->paginate(10);
        // dd($provider_branches);
        // return Inertia::render('ProviderBranches/Index', ['provider_branches' => $provider_branches]);
        return Inertia::render('ProviderBranches/Index', [
            'can' => [
                'create' => auth()->user()->can('provider_branches-create'),
                'edit' => auth()->user()->can('provider_branches-edit'),
                'delete' => auth()->user()->can('provider_branches-delete'),
            ],
            'role' => [
                'system_super_admin' => auth()->user()->hasRole('system_super_admin'),
            ],
            'resource_name' => 'provider_branches',
            'deletable' => false,
            'provider_branches' => $provider_branches
        ]);
    }
    public function create()
    {
        
        $providers=Provider::all();
        $cities=City::all();
        $townships=Township::all();
        return Inertia::render('ProviderBranches/CreateProviderBrancheForm',
        [   
            'providers'=>$providers,
            'cities'=>$cities,
            'townships'=>$townships]);
    }
    public function store(CreateProviderBranchRequest $request)
    {
       $this->providerBranchRepo->create($request->all());
        return redirect()->route('system_dashboard.provider_branches.index')->with('message', 'ProviderBranch was created!');
    }
    public function edit(ProviderBranche $provider_branch)
    {   
        $providers=Provider::all();
        $cities=City::all();
        $townships=Township::all();
        return Inertia::render(
            'ProviderBranches/EditProviderBrancheForm', 
            ['provider_branch' => $provider_branch,
             'cities'=>$cities,
             'townships'=>$townships,
             'providers'=>$providers
        
        ]);
    }
    public function update(ProviderBranche $provider_branch, UpdateProviderBranchRequest $request)
    {
       $this->providerBranchRepo->update($provider_branch,$request->all());
        return redirect()->route('system_dashboard.provider_branches.index')->with('message', 'ProviderBranch was updated.');
    }
    public function destroy(ProviderBranche $provider_branch)
    {
        $provider_branch->delete();
        return redirect()->route('system_dashboard.provider_branches.index')->with('message', 'ProviderBranch was deleted.');
    }
}
