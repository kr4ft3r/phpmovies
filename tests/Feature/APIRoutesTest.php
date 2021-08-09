<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class APIRoutesTest extends TestCase
{
    public function test_api_main_route_exists()
    {
        $this->assertTrue(Route::has('api.movies'));
    }

}
