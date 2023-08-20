<?php

namespace Tests\Feature\Api\System\V1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\Response;

class ProviderControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_system_can_get_providers()
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
    public function test_system_can_get_provider_by_id()
    {
        $response = $this->withHeaders(['Accept' => 'application/json'])->getJson('api/system/v1/providers/1');
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
    public function test_system_can_validate_provider()
    {
        $provider = ['name' => 'Tun', 'email' => ''];
        $response = $this->withHeaders(['Accept' => 'application/json'])->postJson(route('system.providers.store'), $provider);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $errors = json_decode($response->getContent(), true)['errors'];
        $invalid_fields = array_keys($errors);
        fwrite(STDERR, print_r($response->getContent(), TRUE));
        $response->assertJsonValidationErrors($invalid_fields);
    }
}
