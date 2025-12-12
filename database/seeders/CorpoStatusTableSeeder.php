<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CorpoStatusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('corpo_status')->delete();
        
        \DB::table('corpo_status')->insert(array (
            0 => 
            array (
                'id' => 1,
                'descricao' => 'Aguardando necrotomista receber',
                'tipo' => 'primary',
            ),
            1 => 
            array (
                'id' => 2,
                'descricao' => 'Corpo recebido pelo necrotomista',
                'tipo' => 'secondary',
            ),
            2 => 
            array (
                'id' => 3,
                'descricao' => 'Em entrevista pelo serviço social',
                'tipo' => 'info',
            ),
            3 => 
            array (
                'id' => 4,
                'descricao' => 'Com pendências',
                'tipo' => 'danger',
            ),
            4 => 
            array (
                'id' => 5,
                'descricao' => 'Aguardando informações médicas',
                'tipo' => 'warning',
            ),
            5 => 
            array (
                'id' => 6,
                'descricao' => 'Finalizado',
                'tipo' => 'success',
            ),
            6 =>
            array (
                'id' => 7,
                'descricao' => 'Encaminhado para o ITEP',
                'tipo' => 'success'
            ),
            7 =>
            array (
                'id' => 8,
                'descricao' => 'Médico Externo',
                'tipo' => 'success'
            ),
            8 =>
            array(
                'id' => 9,
                'descricao' => 'Encaminhado para a LIGA',
                'tipo' => 'success'
            )
        ));
        
        
    }
}