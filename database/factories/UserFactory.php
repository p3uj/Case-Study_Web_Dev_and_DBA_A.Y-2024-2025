<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'role' => $this->faker->randomElement(['Landlord', 'Tenant']),
            'firstname' => $this->faker->firstName(),
            'lastname' => $this->faker->lastName(),
            'city' => $this->faker->city(),
            'email' => fake()->unique()->safeEmail(),
            'password' => Hash::make('1234'),
            'profile_photo_path' => "sampleProfile.png",
            'bio' => $this->faker->text(100),
        ];
    }

/**
     * Indicate that the user is a landlord.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function landlord(): static
    {
        return $this->state([
            'role' => 'Landlord',
            'bio' => 'Landlord managing multiple properties.',
        ]);
    }

    /**
     * Indicate that the user is a tenant.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function tenant(): static
    {
        return $this->state([
            'role' => 'Tenant',
            'bio' => 'Tenant looking for affordable housing.',
        ]);
    }
}
