<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class addPermissionsCorposAtribuirvoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            'name' => 'corpos_atribuirvo',
            'guard_name' => 'web',
            'descricao' => 'Permite a atribuição da vo aos corpos.',
            'created_at' => now(),
        ]);
    }
}
