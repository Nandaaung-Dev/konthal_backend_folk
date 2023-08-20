<?php

namespace App\Http\Controllers\Dashboard\System;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ShopType\CreateShopTypeRequest;
use App\Http\Requests\Dashboard\ShopType\UpdateShopTypeRequest;
use App\Models\ShopType;
use App\Repositories\Dashboard\System\ShopTypeRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ShopTypeController extends Controller
{
    public $shopTypeRepo;
    public function __construct(ShopTypeRepository $shopTypeRepo)
    {
        //$this->middleware('role:system_super_admin',['only'=>['create','store','edit','delete']]);
        $this->middleware('role:system_super_admin', ['except' => ['index', 'show']]);
        $this->middleware('permission:shop_types-create', ['only' => 'create', 'store']);
        $this->middleware('permission:shop_types-edit', ['only' => 'edit', 'update']);
        $this->shopTypeRepo = $shopTypeRepo;
        $this->shopTypeRepo->setPagination(5);
    }

    public function index()
    {
        // $shop_types = ShopType::all();
        $shop_types = $this->shopTypeRepo->paginate();
        // $shop_types = ShopType::paginate(10);
        // return Inertia::render('ShopTypes/Index', ['shop_types' => $shop_types]);

        return Inertia::render('ShopTypes/Index', [
            'can' => [
                'create' => auth()->user()->can('shop_types-create'),
                'edit' => auth()->user()->can('shop_types-edit'),
                'delete' => auth()->user()->can('shop_types-delete'),
            ],
            'role' => [
                'system_super_admin' => auth()->user()->hasRole('system_super_admin'),
            ],
            'resource_name' => 'shop_types',
            'deletable' => false,
            'shop_types' => $shop_types
        ]);
    }

    public function create()
    {
        return Inertia::render('ShopTypes/CreateShopTypeForm');
    }

    public function store(CreateShopTypeRequest $request)
    {
        $this->shopTypeRepo->create($request->all());
        return redirect()->route('system_dashboard.shop_types.index')->with('message', 'Shoptype was created!');
    }
    public function edit(ShopType $shop_type)
    {
        return Inertia::render('ShopTypes/EditShopTypeForm', ['shop_type' => $shop_type]);
    }
    public function update(ShopType $shop_type, UpdateShopTypeRequest $request)
    {
        $this->shopTypeRepo->update($shop_type,$request->all());
        return redirect()->route('system_dashboard.shop_types.index')->with('message', 'Shoptype was updated!');
    }
    public function destroy(ShopType $shop_type)
    {
        $shop_type->delete();
        return redirect()->route('system_dashboard.shop_types.index')->with('message', 'Shoptype was deleted!');
    }
}
