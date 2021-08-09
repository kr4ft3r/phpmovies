<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class APIRoutesUnauthorizedTest extends TestCase
{
    use RefreshDatabase;

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

    /**
     * Confirm that user with api_limit lower than 1 cannot access API
     */
    public function test_user_without_requests_cannot_access_api()
    {
        $user = $user = User::factory()->APIUser()->NoMoreAPIAccess()->create();
        $this->withHeaders([
            'Authorization' => 'Bearer ' . $user->api_token,
            'Accept' => 'application/json'
        ]);
        $this->get(route('api.movies'))->assertStatus(401);
    }

}
