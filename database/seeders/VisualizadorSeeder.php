<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VisualizadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('roles')->insert(array (
            0 =>
            array (
                'id' => 9,
                'name' => 'Visualizador',
                'guard_name' => 'web',
                'created_at' => '2023-02-10 13:14:37',
                'updated_at' => '2023-02-10 13:14:37',
            ),
        ));
        \DB::table('role_has_permissions')->insert(array (
            1 =>
            array (
                'permission_id' => 2,
                'role_id' => 9,
            ),
            2 =>
            array (
                'permission_id' => 10,
                'role_id' => 9,
            ),
            3 =>
            array (
                'permission_id' => 14,
                'role_id' => 9,
            ),
            4 =>
            array (
                'permission_id' => 18,
                'role_id' => 9,
            ),
            5 =>
            array (
                'permission_id' => 21,
                'role_id' => 9,
            ),
            6 =>
            array (
                'permission_id' => 24,
                'role_id' => 9,
            ),
            7 =>
            array (
                'permission_id' => 27,
                'role_id' => 9,
            ),
            8 =>
            array (
                'permission_id' => 34,
                'role_id' => 9,
            ),
            9 =>
            array (
                'permission_id' => 37,
                'role_id' => 9,
            ),
        ));
    }
}
