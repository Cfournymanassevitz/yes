<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'asd@asd.com',
            'password' => bcrypt(123)
        ]);
        User::factory()->count(10)->create();
    }
}
