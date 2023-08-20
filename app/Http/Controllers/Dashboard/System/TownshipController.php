<?php

namespace App\Http\Controllers\Dashboard\System;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Township\CreateTownshipRequest;
use App\Http\Requests\Dashboard\Township\UpdateTownshipRequest;
use App\Models\City;
use App\Models\Township;
use App\Repositories\Dashboard\System\TownshipRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;


class TownshipController extends Controller
{
    public $townshipRepo;
    public function __construct(TownshipRepository $townshipRepo)
    {
        $this->middleware('role:system_super_admin', ['except' => ['index', 'show']]);
        $this->middleware('permission:townships-create', ['only' => 'create', 'store']);
        $this->middleware('permission:townships-edit', ['only' => 'edit', 'update']);
        $this->townshipRepo = $townshipRepo;
        $this->townshipRepo->setPagination(5);
        $this->townshipRepo->setRelations(['city']);
    }

    public function index()
    {
        // $townships = Township::with([ 'city'])->paginate(5);
        $townships = $this->townshipRepo->paginate();
        return Inertia::render('Townships/Index', [

            'can' => [
                'create' => auth()->user()->can('townships-create'),
                'edit' => auth()->user()->can('townships-edit'),
                'delete' => auth()->user()->can('townships-delete')
            ],
            'role' => [
                'system_super_admin' => auth()->user()->hasRole('system_super_admin')
            ],
            'resource_name' => 'townships',
            'deletable' => false,
            'townships' => $townships

        ]);
    }
    public function create()
    {

        $cities=City::all();
        return Inertia::render('Townships/CreateTownshipForm',
        [ 'cities'=>$cities]);
    }
    public function store(CreateTownshipRequest $request)
    {
       $this->townshipRepo->create($request->all());
        return redirect()->route('system_dashboard.townships.index')->with('message', 'Township was created!');
    }
    public function edit(Township $township)
    {

        $cities=City::all();
        return Inertia::render('Townships/EditTownshipForm',
        ['cities'=>$cities,'township'=>$township]);
    }
    public function update(Township $township, UpdateTownshipRequest $request)
    {
       $this->townshipRepo->update($township,$request->all());
        return redirect()->route('system_dashboard.townships.index')->with('message', 'Township was updated.');
    }
    public function destroy(Township $township)
    {
        $township->delete();
        return redirect()->route('system_dashboard.townships.index')->with('message', 'Township was deleted.');
    }
}
