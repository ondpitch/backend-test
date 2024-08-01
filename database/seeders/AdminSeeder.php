<?php

namespace Database\Seeders;

use App\Enums\RoleStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(
            [
                'name' => 'admin',
                'email' => 'admin@bookings.com',
                'password' => Hash::make('password'),
                'role' => RoleStatus::ADMIN->value,
            ]);
    }
}
