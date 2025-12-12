<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ExamesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('permissions')->insert([
            'name' => 'exames_view',
            'guard_name' => 'web',
            'descricao' => 'Permite a visualização dos exames',
            'created_at' => now(),
        ]);
        \DB::table('permissions')->insert([
            'name' => 'exames_create',
            'guard_name' => 'web',
            'descricao' => 'Permite solicitar um exame',
            'created_at' => now(),
        ]);
        \DB::table('permissions')->insert([
            'name' => 'exames_reply',
            'guard_name' => 'web',
            'descricao' => 'Permite responder um exame',
            'created_at' => now(),
        ]);
    }
}
