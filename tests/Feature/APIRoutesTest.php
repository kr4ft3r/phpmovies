<?php

namespace Tests\Feature;

use Database\Seeders\MovieSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Movie;

class APIRoutesTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_main_route_exists()
    {
        $this->assertTrue(Route::has('api.movies'));
    }

    public function test_movies_index()
    {
        $this->seed(MovieSeeder::class);
        $user = User::factory()->APIUser()->create();
        $response = $this->call('GET', route('api.movies'), ['api_token'=>$user->api_token]);
        $response->assertStatus(200);
        $this->assertJson($response->getContent());
    }

    public function test_movie_show()
    {
        $this->seed(MovieSeeder::class);
        $user = User::factory()->APIUser()->create();
        $movie = Movie::first();
        $response = $this->call('GET', route('api.movies.show',['movie'=>$movie->id]), ['api_token'=>$user->api_token]);
        $response->assertStatus(200);
        $this->assertJson($response->getContent());
    }

    public function test_movie_show_not_found()
    {
        $this->seed(MovieSeeder::class);
        $user = User::factory()->APIUser()->create();
        $movie = Movie::orderBy('id', 'DESC')->first();
        $movie_wrong_id = $movie->id + 1;
        $response = $this->call('GET', route('api.movies.show',['movie'=>$movie_wrong_id]), ['api_token'=>$user->api_token]);
        $response->assertStatus(404);
    }

    public function test_movies_by_category()
    {
        $categories = ['action','drama','comedy','documentary'];
        $this->seed(MovieSeeder::class);
        $user = User::factory()->APIUser()->create();
        foreach($categories as $category) {
            $response = $this->post(route('api.movies.category', ['category'=>$category]), ['api_token'=>$user->api_token]);
            $response->assertStatus(200);
            $this->assertJson($response->getContent());
        }
    }

    public function test_movies_by_title()
    {
        $this->seed(MovieSeeder::class);
        $user = User::factory()->APIUser()->create();
        $movies = Movie::limit(20)->get();
        foreach($movies as $movie) {
            $response = $this->post(route('api.movies.title', ['title'=>$movie->title]), ['api_token'=>$user->api_token]);
            $response->assertStatus(200);
            $this->assertJson($response->getContent());
        }
    }

}
