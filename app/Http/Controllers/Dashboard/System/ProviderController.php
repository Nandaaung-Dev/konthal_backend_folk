<?php

namespace App\Http\Controllers\Dashboard\System;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Provider\CreateProviderRequest;
use App\Http\Requests\Dashboard\Provider\UpdateProviderRequest;
use App\Http\Resources\V1\Provider\ProviderResource;
use App\Models\City;
use App\Models\Provider;
use App\Models\Township;
use App\Repositories\Dashboard\System\ProviderRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProviderController extends Controller
{
    public $providerRepo;
    public function __construct(ProviderRepository $providerRepo)
    {
        // $this->middleware('role:system_super_admin', ['only' => ['create', 'store', 'edit', 'delete']]);
        $this->middleware('role:system_super_admin', ['except' => ['index', 'show']]);
        $this->middleware('permission:providers-create', ['only' => 'create', 'store']);
        $this->middleware('permission:providers-edit', ['only' => 'edit', 'update']);
        $this->providerRepo = $providerRepo;
        $this->providerRepo->setPagination(4);
        $this->providerRepo->setRelations(['city', 'township']);
    }
    public function index()
    {
        // $providers = Provider::with(['city', 'township'])->paginate(10);
        $providers = $this->providerRepo->paginate();
        return Inertia::render('Providers/Index', [
            'can' => [
                'create' => auth()->user()->can('providers-create'),
                'edit' => auth()->user()->can('providers-edit'),
                'delete' => auth()->user()->can('providers-delete'),
            ],
            'role' => [
                'system_super_admin' => auth()->user()->hasRole('system_super_admin'),
            ],
            'resource_name' => 'providers',
            'deletable' => false,
            'providers' => $providers
        ]);
    }
    public function create()
    {   
        $cities=City::all();
        $townships=Township::all();
        return Inertia::render('Providers/CreateProviderForm',
                               ['cities'=>$cities,'townships'=>$townships]);
    }
    public function store(CreateProviderRequest $request)
    {
        $this->providerRepo->create($request->all());
        return redirect()->route('system_dashboard.providers.index')->with('message', 'Provider was created!');
    }
    public function edit(Provider $provider)
    {   
        $cities=City::all();
        $townships=Township::all();
        return Inertia::render('Providers/EditProviderForm', 
                                ['provider' => $provider,
                                 'cities'=>$cities,
                                 'townships'=>$townships
                                ]);
    }
    public function update(Provider $provider, UpdateProviderRequest $request)
    {
        $this->providerRepo->update($provider,$request->all());
        return redirect()->route('system_dashboard.providers.index')->with('message', 'Provider was updated.');
    }
    public function destroy(Provider $provider)
    {
        $provider->delete();
        return redirect()->route('system_dashboard.providers.index')->with('message', 'Provider was deleted.');
    }
}
