<?php

namespace Tests\Feature\Api\System\V1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class BranchControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_system_can_get_branches()
    {
        $response = $this->withHeaders(['Accept'=>'application/json'])->getJson(route('system.branches.index'));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'status',
            'data'=>[
                '*'=>[
                    'id',
                    'name',
                    'name_mm'
                ]
            ]
        ]);
    }

    public function test_system_can_get_branch_by_id()
    {
        $response=$this->withHeaders(['Accept'=>'application/json'])->getJson('api/system/v1/branches/1');
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'status',
            'data'=>[
                'name',
                'name_mm'
            ]
            ]);
    }
    public function test_system_can_store_branch()
    {
        $branch=['name'=>'a','name_mm'=>'b','phone_number'=>'099','address'=>'No.1','description'=>'ff','shoptype_id'=>'1','shop_id'=>'2','city_id'=>'3','township_id'=>'4'];
        $response=$this->withHeaders(['Accept'=>'application/json'])->postJson(route('system.branches.store'),$branch);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonStructure([
            'status',
            'data'=>[
                'name',
                'name_mm',
                'phone_number',
                'address',
                'description',
                'shop_id',
                'shoptype_id',
                'city_id',
                'township_id'
            ]
            ]);
    }

    public function test_system_can_validate_branch()
    {
        $branch=['name'=>'a','name_mm'=>'b','phone_number'=>'099','address'=>'No.1','description'=>'ff','shoptype_id'=>'1','shop_id'=>'2','city_id'=>'3','township_id'=>'4'];
        $response=$this->withHeaders(['Accept'=>'application/json'])->postJson(route('system.branches.store'),$branch);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $errors = json_decode($response->getContent(), true)['errors'];
        $invalid_fields = array_keys($errors);
        fwrite(STDERR, print_r($response->getContent(), TRUE));
        $response->assertJsonValidationErrors($invalid_fields);
    }
}
