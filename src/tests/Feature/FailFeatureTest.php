<?php

namespace Tests\Feature;

use Tests\TestCase;

class FailFeatureTest extends TestCase
{
    public function test_always_fails()
    {
        $this->assertTrue(false);
        
    }
}