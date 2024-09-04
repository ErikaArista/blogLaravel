<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create
        ([
            'full_name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => Hash::make('password'), 
        ]);

        User::create
        ([
            'full_name' => 'Jane Smith',
            'email' => 'jane.smith@example.com',
            'password' => Hash::make('password'), 
        ]);

        User::factory(10)->create();
    }
}
