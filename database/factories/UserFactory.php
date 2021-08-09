<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * State alterations for random API user
     * @return UserFactory
     */
    public function APIUser()
    {
        return $this->state(
            [
                'api_token' => $this->faker->unique()->regexify('[A-Za-z0-9]{60}'), //Str::random(60),
                'api_limit' => 1000,
            ]
        );
    }

    /**
     * State alterations for demo user with known API token, made for testing API
     * @return UserFactory
     */
    public function DemoAPIUser()
    {
        return $this->state(
            [
                'name' => 'Demo User',
                'email' => 'demo@demoapiuser.com',
                'api_token' => "xuusogercnjpzsvyqznfyuceqczpidamjsezxsxwykppudhzgmtgnoxpgahf",
            ]
        );
    }

    public function NoMoreAPIAccess()
    {
        return $this->state(
            [
                'api_limit' => 0,
            ]
        );
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
