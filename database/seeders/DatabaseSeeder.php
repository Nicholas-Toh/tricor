<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enum\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $manager = User::create([
            'name' => 'Marketing Agent Manager ' . 1,
            'login_id' => 'manager ' . 1,
            'password' => Hash::make('1'),
            'role' => UserRole::Manager,
            'contact_no' => '0123456789',
        ]);

        for ($i = 1; $i < 3; $i++) {
            $agent = User::create([
                'name' => 'Marketing Agent ' . $i,
                'login_id' => 'agent ' . $i,
                'password' => Hash::make($i),
                'role' => UserRole::MarketingAgent,
                'contact_no' => '0123456789',
            ]);
            $agent->marketing_agent()->create([
                'manager_id' => $manager->id,
            ]);
        }

        $manager = User::create([
            'name' => 'Marketing Agent Manager ' . 2,
            'login_id' => 'manager ' . 2,
            'password' => Hash::make('2'),
            'role' => UserRole::Manager,
            'contact_no' => '0123456789',
        ]);

        for ($i = 3; $i < 6; $i++) {
            $agent = User::create([
                'name' => 'Marketing Agent ' . $i,
                'login_id' => 'agent ' . $i,
                'password' => Hash::make($i),
                'role' => UserRole::MarketingAgent,
                'contact_no' => '0123456789',
            ]);
            $agent->marketing_agent()->create([
                'manager_id' => $manager->id,
            ]);
        }
    }
}
