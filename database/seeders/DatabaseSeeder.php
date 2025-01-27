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

        // Create a Tenant
        User::factory()
            ->tenant()
            ->create([
                'firstname' => 'Glinda',
                'lastname' => 'Upland',
                'city' => 'Emerald City',
                'email' => 'tenant1@gmail.com',
            ]);
        
        // Create a Tenant
        User::factory()
            ->tenant()
            ->create([
                'firstname' => 'Elphie',
                'lastname' => 'The Wicked',
                'city' => 'Oz City',
                'email' => 'tenant2@gmail.com',
            ]);

        // Create a Tenant
        User::factory()
            ->tenant()
            ->create([
                'firstname' => 'Alice',
                'lastname' => 'Guo1',
                'city' => 'New York City',
                'email' => 'tenant3@gmail.com',
            ]);
        
        // Create a Tenant
        User::factory()
            ->tenant()
            ->create([
                'firstname' => 'Alice',
                'lastname' => 'Guo2',
                'city' => 'New York City',
                'email' => 'tenant4@gmail.com',
            ]);

        // Create a Tenant
        User::factory()
            ->tenant()
            ->create([
                'firstname' => 'Alice',
                'lastname' => 'Guo3',
                'city' => 'New York City',
                'email' => 'tenant5@gmail.com',
            ]);
        
        // Create a Tenant
        User::factory()
            ->tenant()
            ->create([
                'firstname' => 'Alice',
                'lastname' => 'Guo4',
                'city' => 'New York City',
                'email' => 'tenant6@gmail.com',
            ]);

        // Create a Tenant
        User::factory()
            ->tenant()
            ->create([
                'firstname' => 'Alice',
                'lastname' => 'Guo5',
                'city' => 'New York City',
                'email' => 'tenant7@gmail.com',
            ]);

        // Create a Tenant
        User::factory()
            ->tenant()
            ->create([
                'firstname' => 'Alice',
                'lastname' => 'Guo6',
                'city' => 'New York City',
                'email' => 'tenant8@gmail.com',
            ]);
    }
}
