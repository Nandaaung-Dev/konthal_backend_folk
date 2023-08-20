<?php

namespace App\Http\Controllers\Dashboard\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Api\Shop\V1\TownshipRepository;
use Inertia\Inertia;
use App\Models\Township;
use App\Models\City;

class TownshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $townshipRepo;
    public function __construct(TownshipRepository $townshipRepo)
    {
        $this->townshipRepo = $townshipRepo;
        $this->townshipRepo->setPagination(20);
        $this->townshipRepo->setRelations(['city:id,name']);
        // dd($townshipRepo);
    }
    public function index()
    {
        $townships = $this->townshipRepo->paginate(['id', 'name', 'name_mm', 'city_id']);
        $townships = Township::paginate(10);
        // dd($townships);
        return Inertia::render('Townships/Index', [
            'can' => [
                'create' => auth()->user()->can('townships-create'),
                'edit' => auth()->user()->can('townships-edit'),
                'delete' => auth()->user()->can('townships-delete'),
            ],
            'role' => [
                'system_super_admin' => auth()->user()->hasROle('system_super_admin'),
            ],
            'resource_name' => 'townships',
            'deletable' => false,
            'townships' => $townships
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
