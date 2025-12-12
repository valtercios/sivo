<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('permissions')->insert([
            'name' => 'permissoes_view',
            'guard_name' => 'web',
            'descricao' => 'Permite a visualização das permissões',
            'created_at' => now(),
        ]);
    }
}
