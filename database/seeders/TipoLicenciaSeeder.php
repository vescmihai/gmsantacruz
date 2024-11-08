<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoLicenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clean first
        DB::table('tipo_licencias')->truncate();

        DB::table('tipo_licencias')->insert([
            'nombre' => 'Licencia de Funcionamiento para el Servicio de Salud',
            'descripcion' => 'Empadronamiento de licencia de funcionamiento para actividades de servicio de salud humana: Farmacias, Odontólogos, Médicos, etc.',
            'codigo' => 'salud',
            'icono' => '&#x1F4C4;',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('tipo_licencias')->insert([
            'nombre' => 'Licencia de Funcionamiento que expenden Bebidas Alcohólicas',
            'descripcion' => 'Empadronamiento de licencia de funcionamiento para actividades que expenden bebidas alcohólicas: Bares, Licorerías, etc.',
            'codigo' => 'alcohol',
            'icono' => '&#x1F37A;',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('tipo_licencias')->insert([
            'nombre' => 'Licencia de Funcionamiento para venta de Hoja de Coca',
            'descripcion' => 'Empadronamiento de licencia de funcionamiento para la actividad específica de venta de hoja de coca.',
            'codigo' => 'coca',
            'icono' => '&#x1F33F;',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('tipo_licencias')->insert([
            'nombre' => 'Licencia de Funcionamiento para el Servicio de Comida',
            'descripcion' => 'Empadronamiento de licencia de funcionamiento para actividades de servicio de comida: Restaurantes, Pensiones, etc.',
            'codigo' => 'comida',
            'icono' => '&#x1F35D;',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('tipo_licencias')->insert([
            'nombre' => 'Licencia de Funcionamiento para Ópticas',
            'descripcion' => 'Empadronamiento de licencia de funcionamiento para la actividad específica de ópticas.',
            'codigo' => 'optica',
            'icono' => '&#x1F453;',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('tipo_licencias')->insert([
            'nombre' => 'Licencia de Funcionamiento para otros rubros',
            'descripcion' => 'Empadronamiento de licencia de funcionamiento para otros rubros: Talleres mecánicos, tiendas de barrios, etc.',
            'codigo' => 'otros',
            'icono' => '&#x1F527;',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
