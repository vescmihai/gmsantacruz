<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clean first
        DB::table('roles')->truncate();

        DB::table('roles')->insert([
            'name' => 'admin',
            'description' => 'Rol para Admistrar acciones del sistema',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('roles')->insert([
            'name' => 'funcionario',
            'description' => 'Rol para Admistrar acciones del funcionario',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('roles')->insert([
            'name' => 'cliente',
            'description' => 'Rol para Admistrar acciones del usuario comun',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
