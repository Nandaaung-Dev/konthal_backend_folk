<?php

namespace Tests\Feature\Api\System\V1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class ShopTypeControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_system_can_get_shoptypes()
    {
        $response = $this->withHeaders(['Accept'=>'application/json'])->getJson(route('system.shoptypes.index'));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'status',
            'data'=>[
                '*'=>[
                    'name',
                    'name_mm',
                ]
            ]
        ]);
    }
    public function test_system_can_get_shoptype_by_id()
    {
        $response = $this -> withHeaders(['Accept'=>'application/json'])->getJson('api/system/v1/shoptypes/1');
        $response -> assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'status',
            'data' => [
                'name',
                'name_mm'
            ]
        ]);
    }
    public function test_system_can_store_shoptype()
    {
        $shoptype = ['name' => 'Aad', 'name_mm' => 'ada', 'description' => 'abc'];
        $response = $this -> withHeaders(['Accept' => 'application/json'])->postJson(route('system.shoptypes.store'),$shoptype);
        $response -> assertStatus(Response::HTTP_CREATED);
        $response -> assertJsonStructure([
            'status',
            'data' => [
                'name',
                'name_mm',
                'description'
            ]
        ]);
    }
    public function test_system_can_validate_shoptype()
    {
        $shoptype = ['name' => 'Yan', 'name_mm' => '','description'=>''];
        $response = $this->withHeaders(['Accept' => 'application/json'])->postJson(route('system.shoptypes.store'), $shoptype);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        // $response->assertJsonValidationErrors(['name', 'name_mm']);
        // $response->assertJsonPath('errors.name', ['The name field is required.']);
        // $errors = $response->decodeResponseJson();
        $errors = json_decode($response->getContent(), true)['errors'];
        $invalid_fields = array_keys($errors);
        fwrite(STDERR, print_r($response->getContent(), TRUE));
        $response->assertJsonValidationErrors($invalid_fields);
    }
}
