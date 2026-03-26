<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Primero se crean los roles y permisos
        $this->call(Rolseeder::class);

        // Luego se crean los usuarios con roles asignados
        $this->call(UserSeeder::class);
    }
}
