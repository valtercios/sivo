<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Admin',
                'username' => 'admin',
                'cpf' => '00000000000',
                'email' => 'admin@admin.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$6KIf5wD3IXc0RX9G90k1lO9Cn2q.F8YXe397JEaAAvuYIXGrz/bUu',
                'loginhash' => NULL,
                'crm' => NULL,
                'cadastrado_por' => NULL,
                'image' => NULL,
                'setor_id' => NULL,
                'tipo_user_id' => NULL,
                'editado_por' => NULL,
                'atualizacao' => 1,
                'status' => NULL,
                'processos_view' => NULL,
                'two_factor_secret' => NULL,
                'two_factor_recovery_codes' => NULL,
                'two_factor_confirmed_at' => NULL,
                'current_team_id' => NULL,
                'profile_photo_path' => NULL,
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => '2023-05-08 10:49:42',
                'deleted_at' => NULL,
                
            ),
            
        ));
        
        
    }
}