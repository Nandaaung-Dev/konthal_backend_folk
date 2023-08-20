<?php

namespace App\Http\Controllers\Dashboard\System;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\PaymentType\CreatePaymentTypeRequest;
use App\Http\Requests\Dashboard\PaymentType\UpdatePaymentTypeRequest;
use App\Models\PaymentType;
use App\Repositories\Api\Shop\V1\PaymentTypeRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PaymentTypeController extends Controller
{
    public $paymentTypeRepo;
    public function __construct(PaymentTypeRepository $paymentTypeRepo)
    {
        $this->middleware('role:system_super_admin', ['except' => ['index', 'show']]);
        $this->middleware('permission:payment_types-create', ['only' => 'create', 'store']);
        $this->middleware('permission:payment_types-edit', ['only' => 'edit', 'update']);
        $this->paymentTypeRepo = $paymentTypeRepo;
        $this->paymentTypeRepo->setPagination(10);
    
    }
    public function index()
    {

         $payment_types = $this->paymentTypeRepo->paginate();
        return Inertia::render('PaymentTypes/Index', [
            'can' => [
                'create' => auth()->user()->can('payment_types-create'),
                'edit' => auth()->user()->can('payment_types-edit'),
                'delete' => auth()->user()->can('payment_types-delete'),
            ],
            'role' => [
                'system_super_admin' => auth()->user()->hasROle('system_super_admin'),
            ],
            'resource_name' => 'payment_types',
            'deletable' => false,
            'payment_types' => $payment_types
        ]);
    }
    public function create()
    {
        return Inertia::render('PaymentTypes/CreatePaymentTypeForm');
    }
    public function store(CreatePaymentTypeRequest $request)
    {
       $this->paymentTypeRepo->create($request->all());
        return redirect()->route('system_dashboard.payment_types.index')->with('message', 'PaymentType was created!');
    }
    public function edit(PaymentType $payment_type)
    {
        return Inertia::render('PaymentTypes/EditPaymentTypeForm', ['payment_type' => $payment_type]);
    }
    public function update(PaymentType $payment_type, UpdatePaymentTypeRequest $request)
    {
        $this->paymentTypeRepo->update($payment_type,$request->all());
        return redirect()->route('system_dashboard.payment_types.index')->with('message', 'PaymentType was updated.');
    }
    public function destroy(PaymentType $payment_type)
    {
        $payment_type->delete();
        return redirect()->route('system_dashboard.payment_types.index')->with('message', 'PaymentType was deleted.');
    }
}
