<?php

namespace Tests\Feature\Api\Markte\V1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_market_customer_can_get_posts()
    {
        // $response = $this->withHeaders(['Accept' => 'application/json'])->getJson($this->prefix . '/posts');
        $response = $this->withHeaders(['Accept' => 'application/json'])->getJson(route('market.posts.index'));
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'status',
            'data' => [
                '*' => [
                    'id',
                    'title',
                    'content',
                    'is_deleted'
                ]
            ]
        ]);
    }
    public function test_market_customer_can_get_post_by_id()
    {
        $response = $this->withHeaders(['Accept' => 'application/json'])->getJson('api/market/v1/posts/1');
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'status',
            'data' => [
                'id',
                'title',
                'content',
                'is_deleted'
            ]
        ]);
    }
}
