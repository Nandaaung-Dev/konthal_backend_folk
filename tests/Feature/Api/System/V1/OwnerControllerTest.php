<?php

namespace Tests\Feature\Api\System\V1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;


class OwnerControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_system_can_get_owners()
    {
        $response = $this->withHeaders(['Accept'=>'application/json'])->getJson(route('system.owners.index'));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'status',
            'data'=> [
                '*' => [
                    'username',
                    'email',
                    'password',
                    'name',
                    'phone_number',
                    'city_id',
                    'township_id',
                    'address'
                ]
            ]
        ]);
    }
    public function test_system_can_get_owner_by_id()
    {
        $response = $this->withHeaders(['Accept' => 'application/json'])->getJson('api/system/v1/owners/1');
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'status',
            'data' => [
                'username',
                'email',
                'password',
                'name',
                'phone_number',
                'city_id',
                'township_id',
                'address'
            ]
        ]);
    }
    public function test_system_can_store_owner()
    {
        $owner = ['username'=>'AA','email'=>'a@gmail.com','password'=>'123','name' => 'Aaaa','phone_number'=>'94555555','city_id'=>'7','township_id'=>'4','address'=>'Yangon'];
        $response = $this -> withHeaders(['Accept' => 'application/json'])->postJson(route('system.owners.store'),$owner);
        $response -> assertStatus(Response::HTTP_CREATED);
        $response -> assertJsonStructure([
            'status',
            'data' => [
                'username',
                'email',
                'password',
                'name',
                'phone_number',
                'city_id',
                'township_id',
                'address'
            ]
        ]);
    }
    public function test_system_can_validate_owner()
    {
        $owner = ['username'=>'aaa','email'=>'a@gmail.com','password'=>'123','name' => 'Aaaa','phone_number'=>'94555555','city_id'=>'7','township_id'=>'4','address'=>'Yangon'];
        $response = $this->withHeaders(['Accept' => 'application/json'])->postJson(route('system.owners.store'), $owner);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        // $response->assertJsonValidationErrors(['username','name']);
        // $response->assertJsonPath('errors.name', ['The name field is required.']);
        // $errors = $response->decodeResponseJson();
        $errors = json_decode($response->getContent(), true)['errors'];
        $invalid_fields = array_keys($errors);
        fwrite(STDERR, print_r($response->getContent(), TRUE));
        $response->assertJsonValidationErrors($invalid_fields);
    }
    
}
