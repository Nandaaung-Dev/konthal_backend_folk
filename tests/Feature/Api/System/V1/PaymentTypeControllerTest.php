<?php

namespace Tests\Feature\Api\System\V1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\Response;

class PaymentTypeControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_system_can_get_paymenttypes()
    {
        $response = $this->withHeaders(['Accept' => 'application/json'])->getJson(route('system.paymentTypes.index'));
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'status',
            'data' => [
                '*' => [
                    'name',
                    'name_mm',
                ]
            ]
        ]);
    }
    public function test_system_can_get_paymentType_by_id()
    {
        $response = $this->withHeaders(['Accept' => 'application/json'])->getJson('api/system/v1/paymentTypes/1');
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'status',
            'data' => [
                'name',
                'name_mm'
            ]
        ]);
    }
    // public function test_example()
    
}

