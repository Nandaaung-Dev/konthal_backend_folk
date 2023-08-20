<?php

namespace App\Http\Controllers\Dashboard\System;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Shop\UpdateShopRequest;
use App\Http\Requests\Dashboard\Shop\CreateShopRequest;
use App\Models\City;
use App\Models\Owner;
use App\Models\Shop;
use App\Models\ShopType;
use App\Models\Township;
use App\Repositories\Dashboard\System\ShopRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class ShopController extends Controller
{
    public $shopRepo;
    public function __construct(ShopRepository $shopRepo)
    {
        $this->middleware('role:system_super_admin', ['except' => ['index', 'show']]);
        $this->middleware('permission:shops-create', ['only' => 'create', 'store']);
        $this->middleware('permission:shops-edit', ['only' => 'edit', 'update']);
        $this->shopRepo = $shopRepo;
        $this->shopRepo->setRelations(['shop_type', 'owner', 'city', 'township']);
        $this->shopRepo->setPagination(5);
    }

    public function index()
    {
        // $shops = Shop::with(['shop_type', 'owner', 'city', 'township'])->paginate(5);
        $shops = $this->shopRepo->paginate();
        return Inertia::render('Shops/Index', [

            'can' => [
                'create' => auth()->user()->can('shops-create'),
                'edit' => auth()->user()->can('shops-edit'),
                'delete' => auth()->user()->can('shops-delete')
            ],
            'role' => [
                'system_super_admin' => auth()->user()->hasRole('system_super_admin')
            ],
            'resource_name' => 'shops',
            'deletable' => false,
            'shops' => $shops

        ]);
    }
    public function create()
    {
        $shop_types=ShopType::all();
        $owners=Owner::all();
        $cities=City::all();
        $townships=Township::all();
        return Inertia::render('Shops/CreateShopForm',
        [   'shop_types'=>$shop_types,
            'owners'=>$owners,
            'cities'=>$cities,
            'townships'=>$townships]);
    }
    public function store(CreateShopRequest $request )
    {  
       $request['slug']=Str::of($request->name)->slug('-');
       $this->shopRepo->create($request->all());
        return redirect()->route('system_dashboard.shops.index')->with('message', 'Shop was created!');
    }
    public function edit(Shop $shop)
    {
        $shop_types=ShopType::all();
        $owners=Owner::all();
        $cities=City::all();
        $townships=Township::all();
        return Inertia::render('Shops/EditShopForm',
        ['shop' => $shop,
        'shop_types'=>$shop_types,
        'owners'=>$owners,
        'cities'=>$cities,
        'townships'=>$townships ]);
    }
    public function update(Shop $shop, UpdateShopRequest $request)
    {
        $this->shopRepo->update($shop,$request->all());
        return redirect()->route('system_dashboard.shops.index')->with('message', 'Shop was updated.');
    }
    public function destroy(Shop $shop)
    {
        $shop->delete();
        return redirect()->route('system_dashboard.shops.index')->with('message', 'Shop was deleted.');
    }
}
