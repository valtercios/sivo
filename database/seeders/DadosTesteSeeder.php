<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Funeraria;
use App\Models\Corpo;
use App\Models\Endereco;
use App\Models\Responsavel;
use Faker\Factory as Faker;

class DadosTesteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('pt_BR');

        // Órgãos emissores válidos (IDs)
        $orgaosEmissores = [6, 72, 94, 136, 137, 139]; // Corpo de Bombeiro, Diretoria de Identif. Civil, IPC, Polícia Civil, Polícia Federal, Polícia Militar

        // Criar 20 Funerárias
        echo "Criando 20 funerárias...\n";
        for ($i = 1; $i <= 20; $i++) {
            // Criar endereco para a funeraria
            $endereco = Endereco::create([
                'logradouro' => $faker->streetAddress(),
                'numero' => $faker->buildingNumber(),
                'bairro' => $faker->city(),
                'cidade' => $faker->city(),
                'estado' => $faker->randomElement(['RN', 'SP', 'MG', 'RJ', 'BA', 'PR']),
                'cep' => $faker->postcode(),
            ]);

            Funeraria::create([
                'nome' => 'Funerária ' . $faker->lastName() . ' ' . $i,
                'endereco' => $endereco->id,
            ]);
        }
        echo "20 funerárias criadas com sucesso!\n";

        // Criar 100 Responsáveis para os corpos
        echo "Criando 100 responsáveis...\n";
        for ($i = 1; $i <= 100; $i++) {
            $enderecoResp = Endereco::create([
                'logradouro' => $faker->streetAddress(),
                'numero' => $faker->buildingNumber(),
                'bairro' => $faker->city(),
                'cidade' => $faker->city(),
                'estado' => $faker->randomElement(['RN', 'SP', 'MG', 'RJ', 'BA', 'PR']),
                'cep' => $faker->postcode(),
            ]);

            Responsavel::create([
                'nome' => $faker->name(),
                'rg' => $faker->numerify('##.###.###-#'),
                'orgao_emissor' => $faker->randomElement($orgaosEmissores),
                'estado_rg' => $faker->randomElement(['RN', 'SP', 'MG', 'RJ', 'BA', 'PR']),
                'cpf' => $faker->numerify('###.###.###-##'),
                'parente' => true,
                'grau_parentesco' => $faker->randomElement(['pai', 'mãe', 'filho', 'filha', 'irmão', 'irmã', 'cônjuge']),
                'sexo' => $faker->randomElement(['M', 'F']),
                'telefone' => $faker->phoneNumber(),
                'endereco_id' => $enderecoResp->id,
                'numero_documento' => $faker->numerify('##########'),
            ]);
        }
        echo "100 responsáveis criados com sucesso!\n";

        // Criar 100 Corpos
        echo "Criando 100 corpos...\n";
        $funerarias = Funeraria::all();
        $responsaveis = Responsavel::all();
        $statusIds = [1, 2, 3, 4, 5]; // IDs dos status disponíveis
        
        for ($i = 1; $i <= 100; $i++) {
            // Criar endereco para o corpo
            $enderecoCorporal = Endereco::create([
                'logradouro' => $faker->streetAddress(),
                'numero' => $faker->buildingNumber(),
                'bairro' => $faker->city(),
                'cidade' => $faker->city(),
                'estado' => $faker->randomElement(['RN', 'SP', 'MG', 'RJ', 'BA', 'PR']),
                'cep' => $faker->postcode(),
            ]);

            // Criar endereco de obito
            $enderecoObito = Endereco::create([
                'logradouro' => $faker->streetAddress(),
                'numero' => $faker->buildingNumber(),
                'bairro' => $faker->city(),
                'cidade' => $faker->city(),
                'estado' => $faker->randomElement(['RN', 'SP', 'MG', 'RJ', 'BA', 'PR']),
                'cep' => $faker->postcode(),
            ]);

            $dataNascimento = $faker->dateTimeBetween('-80 years', '-18 years');
            $dataEntrada = $faker->dateTimeBetween('-30 days', 'now');
            $dataObito = $faker->dateTimeBetween('-45 days', '-1 days');

            Corpo::create([
                'nome' => $faker->name(),
                'sexo' => $faker->randomElement(['M', 'F']),
                'rg' => $faker->numerify('##.###.###-#'),
                'orgao_emissor' => $faker->randomElement($orgaosEmissores),
                'estado_rg' => $faker->randomElement(['RN', 'SP', 'MG', 'RJ', 'BA', 'PR']),
                'cpf' => $faker->numerify('###.###.###-##'),
                'data_nascimento' => $dataNascimento,
                'data_entrada' => $dataEntrada,
                'data_obito' => $dataObito,
                'local_obito' => $faker->randomElement(['Hospital', 'Residência', 'Via Pública', 'Local de Trabalho']),
                'endereco_corpo_id' => $enderecoCorporal->id,
                'endereco_obito_id' => $enderecoObito->id,
                'num_vo' => $faker->numerify('######'),
                'ano_vo' => date('Y'),
                'status' => $faker->randomElement($statusIds),
                'funeraria_id' => $funerarias->random()->id,
                'responsavel_entrega_id' => $responsaveis->random()->id,
                'situacao' => $faker->randomElement(['identificado', 'não identificado', 'em processamento']),
                'meio_transporte' => $faker->randomElement(['terrestre', 'aéreo', 'aquático']),
            ]);

            if ($i % 20 == 0) {
                echo "  - $i corpos criados...\n";
            }
        }
        echo "100 corpos criados com sucesso!\n";
    }
}
