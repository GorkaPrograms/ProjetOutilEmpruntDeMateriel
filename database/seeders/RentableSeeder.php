<?php

namespace Database\Seeders;

use App\Models\Rentable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RentableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rentable::factory(24)->create();
    }
}
