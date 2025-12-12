<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PapeisPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('permissions')->insert([
            'name' => 'papeis_view',
            'guard_name' => 'web',
            'descricao' => 'Permite a visualização dos papéis',
            'created_at' => now(),
        ]);
        \DB::table('permissions')->insert([
            'name' => 'papeis_edit',
            'guard_name' => 'web',
            'descricao' => 'Permite a edição dos papéis',
            'created_at' => now(),
        ]);
        \DB::table('permissions')->insert([
            'name' => 'papeis_create',
            'guard_name' => 'web',
            'descricao' => 'Permite a criação dos papéis',
            'created_at' => now(),
        ]);
        \DB::table('permissions')->insert([
            'name' => 'papeis_delete',
            'guard_name' => 'web',
            'descricao' => 'Permite a deleção dos papéis',
            'created_at' => now(),
        ]);
    }
}
