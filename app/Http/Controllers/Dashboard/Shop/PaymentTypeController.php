<?php

namespace App\Http\Controllers\Dashboard\Shop;

use App\Http\Controllers\Controller;
use App\Models\PaymentType;
use Illuminate\Http\Request;
use App\Repositories\Api\Shop\V1\PaymentTypeRepository;
use Inertia\Inertia;

class PaymentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public $payment_typeRepo;
    // public function __construct(PaymentTypeRepository $payment_typeRepo)
    // {
    //     $this->$payment_typeRepo = $payment_typeRepo;
    //     $this->$payment_typeRepo->setPagination(20);
    //     // dd($payment_typeRepo);
    // }
    // public function index()
    // {
    //     // $payment_types = $this->payment_typeRepo->paginate(['id']);
    //     $payment_types = PaymentType::paginate(10);
    //     // dd($payment_types);
    //     return Inertia::render('PaymentTypes/Index', [
    //         'can' => [
    //             'create' => auth()->user()->can('payment_types-create'),
    //             'edit' => auth()->user()->can('payment_types-edit'),
    //             'delete' => auth()->user()->can('payment_types-delete'),
    //         ],
    //         'role' => [
    //             'system_super_admin' => auth()->user()->hasROle('system_super_admin'),
    //         ],
    //         'resource_name' => 'payment_types',
    //         'deletable' => false,
    //         'payment_types' => $payment_types
    //     ]);
    // }

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
