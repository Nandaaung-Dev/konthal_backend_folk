<?php

namespace App\Http\Controllers\Api\System\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PaymentMethod\ApiCreatePaymentMethodRequest;
use App\Http\Resources\V1\PaymentMethod\PaymentMethodCollection;
use App\Http\Resources\V1\PaymentMethod\PaymentMethodResource;
use App\Models\PaymentMethod;
use App\Repositories\Api\System\V1\PaymentMethodRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $paymetMethodRepo;
    public function __construct(PaymentMethodRepository $paymetMethodRepo)
    {
        $this->paymetMethodRepo = $paymetMethodRepo;
        
    }
    public function index(Request $request)
    {  
        $this->paymetMethodRepo->setFilters($request->all());
        $paymentmethods = $this->paymetMethodRepo->paginate();
        return new PaymentMethodCollection($paymentmethods);
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
    public function store(ApiCreatePaymentMethodRequest $request)
    {
        $payment_method = auth()->user()->created_payment_methods()->create($request->all());
        return new PaymentMethodResource($payment_method);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentMethod $paymentmethod)
    {
        return new PaymentMethodResource($paymentmethod);
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
    public function update(PaymentMethod $payment_method, ApiCreatePaymentMethodRequest $request)
    {
        $payment_method = $this->paymetMethodRepo->update($payment_method,$request->all());
        return new PaymentMethodResource($payment_method);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paymentmethod=PaymentMethod::find($id);
        $paymentmethod->delete();
        return response()->json(['status'=>'1','successfully deleted']);
    }
}
