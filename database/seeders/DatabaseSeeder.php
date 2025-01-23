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
        User::factory()
            ->landlord()
            ->create([
                'firstname' => 'Elphaba',
                'lastname' => 'Thropp',
                'city' => 'Emerald City',
                'email' => 'landlord@gmail.com',
            ]);

        // Create a Tenant
        User::factory()
            ->tenant()
            ->create([
                'firstname' => 'Alice',
                'lastname' => 'Guo',
                'city' => 'New York City',
                'email' => 'tenant@gmail.com',
            ]);
    }
}
