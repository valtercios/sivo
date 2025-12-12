<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AtribuirVOPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('permissions')->insert([
            'name' => 'corpos_atribuirvo',
            'guard_name' => 'web',
            'descricao' => 'Permite atribuir um número de VO a um corpo',
            'created_at' => now(),
        ]);
    }
}
