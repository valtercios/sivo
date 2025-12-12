<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EntrevistasPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('permissions')->insert([
            'name' => 'entrevistas_view',
            'guard_name' => 'web',
            'descricao' => 'Permite a visualização das entrevistas',
            'created_at' => now(),
        ]);
        \DB::table('permissions')->insert([
            'name' => 'entrevistas_create',
            'guard_name' => 'web',
            'descricao' => 'Permite a criação de uma nova entrevista',
            'created_at' => now(),
        ]);
        \DB::table('permissions')->insert([
            'name' => 'entrevistas_edit',
            'guard_name' => 'web',
            'descricao' => 'Permite a edição de uma entrevista',
            'created_at' => now(),
        ]);
    }
}
