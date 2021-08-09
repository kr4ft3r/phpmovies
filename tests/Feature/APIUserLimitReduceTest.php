<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;

class APIUserLimitReduceTest extends TestCase
{
    /**
     * Confirm that user's api_limit is reduced by 1 with each request
     */
    public function test_user_api_limit_gets_reduced()
    {
        $user = $user = User::factory()->APIUser()->create();
        $requestsLeft = $user->api_limit;
        $this->withHeaders([
            'Authorization' => 'Bearer ' . $user->api_token,
            'Accept' => 'application/json'
        ]);
        $this->get(route('api.movies'));

        $user = User::find($user->id);
        $this->assertTrue( $requestsLeft - $user->api_limit == 1 ); // Has lost one request
    }
}
