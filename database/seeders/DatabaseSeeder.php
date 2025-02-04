<?php

namespace Database\Seeders;

use App\Models\Employer;
use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::factory()->create([
            'firstName' => 'John',
            'lastName' => 'Doe',
            'email' => 'john@example.com',
            'password' => 'password',
        ]);

        $employer = Employer::factory()->create([
            'user_id' => $user->id,
        ]);

        job::factory(10)->create([
            'employer_id' => $employer->id,
        ]);
        
        $this->call(JobSeeder::class);
    }
}
