<?php

namespace App\Http\Controllers\Dashboard\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Region;
use App\Repositories\Api\Shop\V1\CityRepository;
use Inertia\Inertia;

class CityController extends Controller
{
    public $cityRepo;
    public function __construct(CityRepository $cityRepo)
    {
        $this->cityRepo = $cityRepo;
        $this->cityRepo->setPagination(20);
        $this->cityRepo->setRelations(['region:id,name']);
        // dd($cityRepo);
    }
    public function index()
    {

        $cities = $this->cityRepo->paginate(['id', 'name', 'name_mm', 'region_id']);
        return Inertia::render('Cities/Index', [
            'can' => [
                'create' =>true ,
                'edit' => true,
                'delete' => false,
            ],
            'resource_name' => 'cities',
            'deletable' => false,
            'cities' => $cities
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
