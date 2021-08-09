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

    /**
     * Set Accept header to avoid redirection to login in case of unauthorized,
     * set Authorization bearer token
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->getBearerToken(),
            'Accept' => 'application/json'
        ]);
    }

    protected function getBearerToken()
    {
        $user = User::factory()->APIUser()->create();
        return $user->api_token;
    }

    /**
     * Confirm that movies index for authenticated users returns status 200 and json response
     */
    public function test_movies_index()
    {
        $this->assertTrue(Route::has('api.movies'));
        $this->seed(MovieSeeder::class);
        $user = User::factory()->APIUser()->create();
        $response = $this->get(route('api.movies'));
        $response->assertStatus(200);
        $this->assertJson($response->getContent());
    }

    /**
     * Confirm that show movie route for authenticated users returns status 200 and json response
     */
    public function test_movie_show()
    {
        $this->seed(MovieSeeder::class);
        $user = User::factory()->APIUser()->create();
        $movie = Movie::first();
        $response = $this->get(route('api.movies.show',['movie'=>$movie->id]));
        $response->assertStatus(200);
        $this->assertJson($response->getContent());
    }

    /**
     * Confirm that requesting non-existent movie ID will return resource not found status
     */
    public function test_movie_show_not_found()
    {
        $this->seed(MovieSeeder::class);
        $user = User::factory()->APIUser()->create();
        $movie = Movie::orderBy('id', 'DESC')->first();
        $movie_wrong_id = $movie->id + 1;
        $response = $this->get(route('api.movies.show',['movie'=>$movie_wrong_id]));
        $response->assertStatus(404);
    }

    /**
     * Confirm that search by category route returns status 200 and json response
     */
    public function test_movies_by_category()
    {
        $categories = ['action','drama','comedy','documentary'];
        $this->seed(MovieSeeder::class);
        foreach($categories as $category) {
            $response = $this->get(route('api.movies.category', ['category'=>$category]));
            $response->assertStatus(200);
            $this->assertJson($response->getContent());
        }
    }

    /**
     * Confirm that search by title route returns status 200 and json response
     */
    public function test_movies_by_title()
    {
        $this->seed(MovieSeeder::class);
        $movies = Movie::limit(20)->get();
        foreach($movies as $movie) {
            $response = $this->get(route('api.movies.title', ['title'=>$movie->title]));
            $response->assertStatus(200);
            $this->assertJson($response->getContent());
        }
    }

}
