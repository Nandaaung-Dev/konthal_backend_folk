<?php

namespace Tests\Feature\Api\System\V1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class ShopControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    
    public function test_system_can_get_shops()
    {
        $response = $this->withHeaders(['Accept' => 'application/json'])->getJson(route('system.shops.index'));
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'status',
            'data'=>[
              '*' =>[
                'id',
                'name',
                'name_mm'
              ] 
            ]
        ]);
    }
    public function test_system_can_get_shop_by_id()
    {
        $response=$this->withHeaders(['Accept'=>'application/json'])->getJson('api/system/v1/shops/1');
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'status',
            'data'=>[
                'name',
                'name_mm'
            ]
            ]);
    }
    public function test_system_can_store_shop()
    {
        $shop=['name'=>'YGN3','name_mm'=>'Yangon','phone_number'=>'0999999','address'=>'no.1','description'=>'mm','shoptype_id'=>'1','owner_id'=>'2','city_id'=>'3','township_id'=>'4'];
        $response = $this->withHeaders(['Accept' => 'application/json'])->postJson(route('system.shops.store'), $shop);
        $response->assertStatus(Response::HTTP_ACCEPTED);
        $response->assertJsonStructure([
            'status',
            'data'=>[
                'name',
                'name_mm',
                'phone_number',
                'address',
                'description',
                'shoptype_id',
                'owner_id',
                'city_id',
                'township_id'
            ]
         ]);
    }
    public function test_system_can_validate_shop()
    {
        $shop=['name'=>'YGN','name_mm'=>'','phone_number'=>'09999999999','address'=>'no.1','description'=>'mm','shoptype_id'=>'1','owner_id'=>'2','city_id'=>'3','township_id'=>'4'];
        $response = $this->withHeaders(['Accept' => 'application/json'])->postJson(route('system.shops.store'), $shop);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        
        $errors = json_decode($response->getContent(), true)['errors'];
        $invalid_fields = array_keys($errors);
        fwrite(STDERR, print_r($response->getContent(), TRUE));
        $response->assertJsonValidationErrors($invalid_fields);
    }
}
