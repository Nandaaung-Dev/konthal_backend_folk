<?php

namespace App\Http\Controllers\Dashboard\System;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Branch\CreateBranchRequest;
use App\Http\Requests\Dashboard\Branch\UpdateBranchRequest;
use App\Models\Branch;
use App\Models\City;
use App\Models\Shop;
use App\Models\ShopType;
use App\Models\Township;
use App\Repositories\Dashboard\System\BranchRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BranchController extends Controller
{
    public $branchRepo;
    public function __construct(BranchRepository $branchRepo)
    {
        $this->middleware('role:system_super_admin', ['except' => ['index', 'show']]);
        $this->middleware('permission:branchs-create', ['only' => 'create', 'store']);
        $this->middleware('permission:branchs-edit', ['only' => 'edit', 'update']);
        $this->branchRepo = $branchRepo;
        $this->branchRepo->setRelations(['shop', 'shop_type', 'city', 'township']);
        $this->branchRepo->setPagination(5);
        
    }

    public function index()
    {
        // $branches = Branch::with(['shop', 'shop_type', 'city', 'township'])->paginate(5);
        $branches = $this->branchRepo->paginate();
        return Inertia::render('Branches/Index', [
            'can' => [
                'create' => auth()->user()->can('branchs-create'),
                'edit' => auth()->user()->can('branchs-edit'),
                'delete' => auth()->user()->can('branchs-delete')
            ],
            'role' => [
                'system_super_admin' => auth()->user()->hasRole('system_super_admin')
            ],
            'resource_name' => 'branches',
            'deletable' => false,
            'branches' => $branches
        ]);
    }
    public function create()
    {

        $shops=Shop::all();
        $shop_types=ShopType::all() ;
        $cities=City::all();
        $townships=Township::all();
        return Inertia::render('Branches/CreateBranchForm',
        [
            'shops'=>$shops,
            'shop_types'=>$shop_types,
            'cities'=>$cities,
            'townships'=>$townships
        ]);
    }
    public function store(CreateBranchRequest  $request)
    {
        $this->branchRepo->create($request->all());
        return redirect()->route('system_dashboard.branches.index')->with('message', 'Branch was created!');
    }
    public function edit(Branch $branch)
    {
        $shops=Shop::all();
        $shop_types=ShopType::all() ;
        $cities=City::all();
        $townships=Township::all();
        return Inertia::render('Branches/EditBranchForm',
        ['branch' => $branch,
        'shops'=>$shops,
        'shop_types'=>$shop_types,
        'cities'=>$cities,
        'townships'=>$townships]);
    }
    public function update(Branch $branch, UpdateBranchRequest $request)
    {
        $this->branchRepo->update($branch,$request->all());
        return redirect()->route('system_dashboard.branches.index')->with('message', 'Branch was updated.');
    }
    public function destroy(Branch $branch)
    {
        $branch->delete();
        return redirect()->route('system_dashboard.branches.index')->with('message', 'Branch was deleted.');
    }
}
