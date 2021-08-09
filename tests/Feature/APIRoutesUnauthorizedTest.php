<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class APIRoutesUnauthorizedTest extends TestCase
{

    /**
     * Confirm that guest user will no be able to access API routes
     */
    public function test_guest_cannot_access_api()
    {
        $this->withHeaders([
            'Accept' => 'application/json'
        ]);
        $this->get(route('api.movies'))->assertStatus(401);
    }

}
