<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ExamesStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('exames_status')->insert(array (
            0 => 
            array (
                'id' => 1,
                'descricao' => 'Aguardando resposta',
                'tipo' => 'warning',
            ),
            1 => 
            array (
                'id' => 2,
                'descricao' => 'Exame respondido',
                'tipo' => 'success',
            ),
        ));
    }
}
