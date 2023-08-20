<?php

namespace Tests\Feature\Api\System\V1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class TownshipControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_system_can_get_townships()
    {
        $response = $this->withHeaders(['Accept' => 'application/json'])->getJson(route('system.townships.index'));
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'status',
            'data' => [
                '*' => [
                    'name',
                    'name_mm'
                ]
            ]
        ]);
    }
}
