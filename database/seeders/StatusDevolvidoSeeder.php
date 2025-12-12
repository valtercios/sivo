<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StatusDevolvidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('corpo_status')->insert(array(
            0 =>
            array(
                'id' => 10,
                'descricao' => 'Devolvido',
                'tipo' => 'warning',
            )
        ));
    }
}
