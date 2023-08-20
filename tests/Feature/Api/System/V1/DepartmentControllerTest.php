<?php

namespace Tests\Feature\Api\System\V1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\Response;

class DepartmentControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */public function test_system_can_get_departments()
    {
        $response = $this->withHeaders(['Accept' => 'application/json'])->getJson(route('system.departments.index'));
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
    public function test_system_can_get_department_by_id()
    {
        $response = $this->withHeaders(['Accept' => 'application/json'])->getJson('api/system/v1/departments/1');
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
