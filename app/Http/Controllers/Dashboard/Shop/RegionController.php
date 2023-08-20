<?php

namespace App\Http\Controllers\Dashboard\Shop;

use App\Models\Region;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Api\Shop\V1\RegionRepository;
use Inertia\Inertia;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $regionRepo;
    public function __construct(RegionRepository $regionRepo)
    {
        $this->regionRepo = $regionRepo;
        $this->regionRepo->setPagination(20);
        // dd($cityRepo);
    }
    public function index()
    {

        $regions = Region::paginate(10);
        return Inertia::render('Regions/Index', [
            'can' => [
                'create' => false,
                'edit' => false,
                'delete' => false,
            ],
            'role' => [
                'system_super_admin' => true,
            ],
            'resource_name' => 'regions',
            'deletable' => false,
            'regions' => $regions
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

}
