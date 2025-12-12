<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LaudoStatusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('laudo_status')->delete();
        
        \DB::table('laudo_status')->insert(array (
            0 => 
            array (
                'id' => 1,
                'descricao' => 'Aguardando informações médicas',
                'tipo' => 'warning',
            ),
            1 => 
            array (
                'id' => 2,
                'descricao' => 'Informações preenchidas',
                'tipo' => 'success',
            ),
        ));
        
        
    }
}