<?php

namespace App\Http\Controllers\Dashboard\System;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\City\CreateCityRequest;
use App\Http\Requests\Dashboard\City\UpdateCityRequest;
use App\Models\City;
use App\Models\Region;
use App\Repositories\Dashboard\System\CityRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CityController extends Controller
{
    public $cityRepo;
    public function __construct(CityRepository $cityRepo)
    {
        $this->middleware('role:system_super_admin', ['except' => ['index', 'show']]);
        $this->middleware('permission:cities-create', ['only' => 'create', 'store']);
        $this->middleware('permission:cities-edit', ['only' => 'edit', 'update']);
        $this->cityRepo = $cityRepo;
        $this->cityRepo->setRelations('region');
        $this->cityRepo->setPagination(10);
    
    }
    public function index()
    {

        $cities = $this->cityRepo->paginate();
        // $cities = City::with(['region'])->paginate(10);
        return Inertia::render('Cities/Index', [
            'can' => [
                'create' => auth()->user()->can('cities-create'),
                'edit' => auth()->user()->can('cities-edit'),
                'delete' => auth()->user()->can('cities-delete'),
            ],
            'role' => [
                'system_super_admin' => auth()->user()->hasROle('system_super_admin'),
            ],
            'resource_name' => 'cities',
            'deletable' => false,
            'cities' => $cities
        ]);
    }
    public function create()
    {
        $regions = Region::all();
        return Inertia::render('Cities/CreateCityForm', ['regions' => $regions]);
    }
    public function store(CreateCityRequest $request)
    {
        $this->cityRepo->create($request->all());
        return redirect()->route('system_dashboard.cities.index')->with('message', 'city was created!');
    }
    public function Edit(City $city)
    {
        $regions = Region::all();
        return Inertia::render('Cities/EditCityForm', ['regions' => $regions, 'city' => $city]);
    }
    public function update(City $city,UpdateCityRequest $request)
    {
        $this->cityRepo->update($city,$request->all());
        return redirect()->route('system_dashboard.cities.index')->with('message', 'city was updated.');
    }
    public function destroy(City $city)
    {
        $city->delete();
        return redirect()->route('system_dashboard.cities.index')->with('message', 'city was deleted.');
    }
}
