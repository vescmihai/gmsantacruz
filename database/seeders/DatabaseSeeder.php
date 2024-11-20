<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call other migrations
        $this->call([
            EstadoTramiteSeeder::class,
            TipoLicenciaSeeder::class,
            RolSeeder::class,
        ]);

        // Create Super User
        DB::table('users')->truncate();

        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'rol_id' => '1',
            'wallet_address' => '0xadmin',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
