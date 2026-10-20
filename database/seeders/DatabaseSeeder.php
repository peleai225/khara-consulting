<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Installe le contenu de base du site. Idempotent (updateOrCreate).
     * La création du compte administrateur se fait séparément (voir DEPLOYMENT.md).
     */
    public function run(): void
    {
        $this->call([
            SettingsSeeder::class,
            ServiceSeeder::class,
            PageSeeder::class,
            FaqSeeder::class,
            ProgramSeeder::class,
            ContentBlockSeeder::class,
        ]);
    }
}
