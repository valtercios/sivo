<?php

namespace Database\Seeders;

use App\Models\Ocupacao;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class cnaeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = Storage::get('jsons/cnae.json');
        $data = json_decode($json, true);

        $arr = array();

        foreach ($data as $key => $value) {
            array_push($arr, [
                'ds_ocupacao' => $value['descricao'],
                'co_cbo' => $value['codigo'],
                'TIPO' => $value['tipo'],
            ]);
        }
        Ocupacao::insert($arr);
    }
}
