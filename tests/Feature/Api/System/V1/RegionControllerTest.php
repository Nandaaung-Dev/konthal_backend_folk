<?php

namespace Tests\Feature\Api\System\V1;

use Database\Factories\RegionFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class RegionControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // use RefreshDatabase;
    public function test_system_can_get_regions()
    {
        $response = $this->withHeaders(['Accept' => 'application/json'])->getJson(route('system.regions.index'));
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'status',
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'name_mm'
                ]
            ]
        ]);
    }
    public function test_system_can_get_region_by_id()
    {
        $response = $this->withHeaders(['Accept' => 'application/json'])->getJson('api/system/v1/regions/1');
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'status',
            'data' => [
                'name',
                'name_mm'
            ]
        ]);
    }
    public function test_system_can_store_region()
    {
        $region = ['name' => 'Yan', 'name_mm' => 'YGN'];
        $response = $this->withHeaders(['Accept' => 'application/json'])->postJson(route('system.regions.store'), $region);
        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJsonStructure([
            'status',
            'data' => [
                'name',
                'name_mm'
            ]
        ]);
    }
    public function test_system_can_validate_region()
    {
        $region = ['name' => 'Yan', 'name_mm' => ''];
        $response = $this->withHeaders(['Accept' => 'application/json'])->postJson(route('system.regions.store'), $region);
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
