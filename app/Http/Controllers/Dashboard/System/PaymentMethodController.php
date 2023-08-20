<?php

namespace App\Http\Controllers\Dashboard\System;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\PaymentMethod\CreatePaymentMethodRequest;
use App\Http\Requests\Dashboard\PaymentMethod\UpdatePaymentMethodRequest;
use App\Models\PaymentMethod;
use App\Repositories\Api\Shop\V1\PaymentMethodRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PaymentMethodController extends Controller
{
    public $paymentMethRepo;
    public function __construct(PaymentMethodRepository $paymentMethRepo)
    {
        $this->middleware('role:system_super_admin', ['except' => ['index', 'show']]);
        $this->middleware('permission:payment_methods-create', ['only' => 'create', 'store']);
        $this->middleware('permission:payment_methods-edit', ['only' => 'edit', 'update']);
        $this->paymentMethRepo = $paymentMethRepo;
        $this->paymentMethRepo->setPagination(10);
    
    }
    public function index()
    {

         $payment_methods = $this->paymentMethRepo->paginate();
        return Inertia::render('PaymentMethods/Index', [
            'can' => [
                'create' => auth()->user()->can('payment_methods-create'),
                'edit' => auth()->user()->can('payment_methods-edit'),
                'delete' => auth()->user()->can('payment_methods-delete'),
            ],
            'role' => [
                'system_super_admin' => auth()->user()->hasROle('system_super_admin'),
            ],
            'resource_name' => 'payment_methods',
            'deletable' => false,
            'payment_methods' => $payment_methods
        ]);
    }
    public function create()
    {
        return Inertia::render('PaymentMethods/CreatePaymentMethodForm');
    }
    public function store(CreatePaymentMethodRequest $request)
    {
       $this->paymentMethRepo->create($request->all());
        return redirect()->route('system_dashboard.payment_methods.index')->with('message', 'PaymentMethod was created!');
    }
    public function edit(PaymentMethod $payment_method)
    {
        return Inertia::render('PaymentMethods/EditPaymentMethodForm', ['payment_method' => $payment_method]);
    }
    public function update(PaymentMethod $payment_method, UpdatePaymentMethodRequest $request)
    {
        $this->paymentMethRepo->update($payment_method,$request->all());
        return redirect()->route('system_dashboard.payment_methods.index')->with('message', 'PaymentMethod was updated.');
    }
    public function destroy(PaymentMethod $payment_method)
    {
        $payment_method->delete();
        return redirect()->route('system_dashboard.payment_methods.index')->with('message', 'PaymentMethod was deleted.');
    }
}
