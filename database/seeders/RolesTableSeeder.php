<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Administrador',
                'guard_name' => 'web',
                'created_at' => '2023-05-08 10:49:15',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Recepção',
                'guard_name' => 'web',
                'created_at' => '2023-02-10 13:07:09',
                'updated_at' => '2023-02-10 13:07:09',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Necrotomista',
                'guard_name' => 'web',
                'created_at' => '2023-02-10 13:07:14',
                'updated_at' => '2023-02-10 13:07:14',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Serviço Social',
                'guard_name' => 'web',
                'created_at' => '2023-02-10 13:07:18',
                'updated_at' => '2023-02-10 13:07:18',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Médico',
                'guard_name' => 'web',
                'created_at' => '2023-02-10 13:07:22',
                'updated_at' => '2023-02-10 13:07:22',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Secretária',
                'guard_name' => 'web',
                'created_at' => '2023-02-10 13:07:26',
                'updated_at' => '2023-02-10 13:07:26',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Direção',
                'guard_name' => 'web',
                'created_at' => '2023-02-10 13:13:59',
                'updated_at' => '2023-02-10 13:13:59',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Laboratório',
                'guard_name' => 'web',
                'created_at' => '2023-02-10 13:14:37',
                'updated_at' => '2023-02-10 13:14:37',
            ),
        ));
        
        
    }
}