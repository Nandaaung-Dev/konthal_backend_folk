<?php

namespace Tests\Feature\Api\V1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_posts()
    {
        $response = $this->withHeaders(['Accept' => 'application/json'])->getJson(route('posts.index'));
        $response->assertStatus(200);
    }
}
