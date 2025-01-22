<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a Landlord
        User::factory()->create([
            'role' => 'Landlord',
            'firstname' => 'Elphaba',
            'lastname' => 'Thropp',
            'city' => 'Emerald',
            'email' => 'landlord@gmail.com',
        ]);

        // Create a Tenant
        User::factory()->create([
            'role' => 'Tenant',
            'firstname' => 'Alice',
            'lastname' => 'Guo',
            'city' => 'New York',
            'email' => 'tenant@gmail.com',
        ]);
    }
}
