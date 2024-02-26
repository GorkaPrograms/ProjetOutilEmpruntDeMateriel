<?php

namespace Database\Seeders;

use App\Models\Rentable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RentableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Supprimer les données de la table en respectant les contraintes de clé étrangère
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Rentable::query()->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Rentable::factory(24)->create();
    }
}
