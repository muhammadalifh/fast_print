<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'name' => 'Admin',
                'email' => 'admin@mail.com',
                'password' => bcrypt('password'),
            ],
        ];

        foreach ($user as $key => $value) {
            \App\Models\User::create($value);
        }
    }
}
