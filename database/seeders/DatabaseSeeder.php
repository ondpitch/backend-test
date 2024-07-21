<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'Admin', 'slug' => 'admin'],
            ['name' => 'User', 'slug' => 'user'],
        ];
        //create roles
        foreach ($roles as $role) {
            Role::create($role);
        }
        User::factory()->count(10)->create(['role_id' => 2]);

        User::factory()->create([
            'name' => 'John',
            'email' => 'john@gmail.com',
            'role_id' => 1,
            'password' => bcrypt('password'),
        ]);

        // create bookings
        Booking::factory()->count(10)->create();
    }
}
