<?php

namespace Database\Factories;
// database/factories/CorpoFactory.php

use App\Models\Corpo;
use Illuminate\Database\Eloquent\Factories\Factory;

class CorpoFactory extends Factory
{
    protected $model = Corpo::class;

    public function definition()
    {
        return [
            'responsavel_corpo_id' =>1,
            'responsavel_entrega_id' => 2,
            'cpf' => $this->faker->numerify('###.###.###-##'),
            'data_nascimento' => $this->faker->dateTime('now'),
            'nome' => $this->faker->name,
            'laudo' => null,
            'entrevista_id' => null,
            'num_vo' => $this->faker->randomNumber(4),
            'ano_vo' => $this->faker->year,
            'status' => $this->faker->numberBetween(1, 5),
            'status_anterior' => $this->faker->numberBetween(1, 5),
            'sexo' => $this->faker->randomElement(['M', 'F']),
            'rg' => $this->faker->numerify('#########'),
            'orgao_emissor' => $this->faker->numberBetween(1, 10),
            'estado_rg' => $this->faker->stateAbbr,
            'endereco_corpo_id' => 2,
            'data_entrada' => $this->faker->dateTimeThisYear,
            'data_obito' => $this->faker->dateTimeThisYear,
            'local_obito' => $this->faker->randomElement(['Domicílio', 'Hospital']),
            'situacao' => $this->faker->word,
            'endereco_obito_id' =>2,
            'meio_transporte' => $this->faker->randomElement(['Funeraria', 'Carro particular', 'Outros']),
            'meio_transporte_outro' => null,
            'funeraria_id' => $this->faker->numberBetween(1, 10),
            'funeraria_retirada_id' => 1,
            'necrotomista_id' => 1,
            'corpoSera' => $this->faker->randomElement(['cremado', 'sepultado']),
            'pertences' => $this->faker->word,
            'cadastradoPor' => 1,
            'encaminhar_liga' => $this->faker->randomNumber(1),
            'pendencias' => $this->faker->numberBetween(0, 1),
            'observacoes' => $this->faker->sentence,
            'estabelecimento_obito' => $this->faker->word,
            'cnes_estabelecimento' => $this->faker->word,
            'natimorto' => $this->faker->boolean,
            'encaminhar_itep' => $this->faker->randomNumber(1),
            'nacionalidade' => $this->faker->country,
        ];
    }
}
