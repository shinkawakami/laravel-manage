<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleFeatureTest extends TestCase
{
    /**
     * 基本のGETリクエストテスト.
     */
    public function test_basic_route_returns_ok()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}