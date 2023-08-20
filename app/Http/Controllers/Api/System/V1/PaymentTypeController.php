<?php

namespace App\Http\Controllers\Api\System\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PaymentType\ApiCreatePaymentTypeRequest;
use App\Http\Requests\Api\PaymentType\ApiUpdatePaymentTypeRequest;
use App\Http\Resources\V1\PaymentType\PaymentTypeCollection;
use App\Http\Resources\V1\PaymentType\PaymentTypeResource;
use App\Models\PaymentType;
use App\Repositories\Api\System\V1\PaymentTypeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class PaymentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $paymentTypeRepo;
    public function __construct(PaymentTypeRepository $paymentTypeRepo)
    {
        $this->paymentTypeRepo = $paymentTypeRepo;
        
    }
    public function index(Request $request)
    {  
        $this->paymentTypeRepo->setFilters($request->all());
        $paymentTypes = $this->paymentTypeRepo->paginate();
        return new PaymentTypeCollection($paymentTypes);
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
    public function store(ApiCreatePaymentTypeRequest $request)
    {
        $payment_type = auth()->user()->created_payment_types()->create($request->all());
        return new PaymentTypeResource($payment_type);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentType $paymentType)
    {
        return new PaymentTypeResource($paymentType);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PaymentType $payment_type, ApiUpdatePaymentTypeRequest $request)
    {
        $payment_type = $this->paymentTypeRepo->update($payment_type,$request->all());
        return new PaymentTypeResource($payment_type);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paymentType=PaymentType::find($id);
        $paymentType->delete();
        return response()->json(['status'=>'1','successfully deleted']);
    }
}
