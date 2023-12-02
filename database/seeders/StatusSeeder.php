<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $status = [
            [
                'nama_status' => 'bisa di jual',
            ],
            [
                'nama_status' => 'tidak bisa di jual',
            ],
        ];

        foreach ($status as $key => $value) {
            \App\Models\Status::create($value);
        }
    }
}
