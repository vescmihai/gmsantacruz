<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoTramiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clean first
        DB::table('estado_tramites')->truncate();

        DB::table('estado_tramites')->insert([
            'nombre' => 'Pendiente',
            'descripcion' => 'Estado pendiente: Aun no se ha realizado la revisión de su tramite',
            'color' => '#6c757d',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('estado_tramites')->insert([
            'nombre' => 'Aprobado',
            'descripcion' => 'Estado aprobado: Se ha emitido la licencia',
            'color' => '#28a745',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('estado_tramites')->insert([
            'nombre' => 'Observado',
            'descripcion' => 'Estado observado: Comunicarse para indentificar la causa',
            'color' => '#ffc107',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('estado_tramites')->insert([
            'nombre' => 'Rechazado',
            'descripcion' => 'Estado rechazado: Comunicarse para indentificar la causa',
            'color' => '#dc3545',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
