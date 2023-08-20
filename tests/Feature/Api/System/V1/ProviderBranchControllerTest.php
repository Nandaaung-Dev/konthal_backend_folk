<?php

namespace Tests\Feature\Api\System\V1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\Response;

class ProviderBranchControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_system_can_get_providerBranches()
    {
        $response = $this->withHeaders(['Accept' => 'application/json'])->getJson(route('system.providerBranches.index'));
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'status',
            'data' => [
                '*' => [
                    'name',
                    'phone',
                    'email'
                ]
            ]
        ]);
    }
    public function test_system_can_get_providerBranche_by_id()
    {
        $response = $this->withHeaders(['Accept' => 'application/json'])->getJson('api/system/v1/providerBranches/1');
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'status',
            'data' => [
                'name',
                'email',
                'phone'

            ]
        ]);
    }
    public function test_system_can_validate_providerBranche()
    {
        $providerBranche = ['name' => 'Lin', 'email' => ''];
        $response = $this->withHeaders(['Accept' => 'application/json'])->postJson(route('system.providerBranches.store'), $providerBranche);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $errors = json_decode($response->getContent(), true)['errors'];
        $invalid_fields = array_keys($errors);
        fwrite(STDERR, print_r($response->getContent(), TRUE));
        $response->assertJsonValidationErrors($invalid_fields);
    }
}
