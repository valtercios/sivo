<?php

namespace App\Http\Controllers\Relatorios;

use App\Http\Controllers\Controller;
use App\Models\Corpo;
use App\Models\Endereco;
use App\Models\Funeraria;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LocalOcorrenciaController extends Controller
{
    public function index(Request $request)
    {
        $obitos = Corpo::with('enderecoCorpo');
        $estados = Endereco::get('estado')->unique('estado');
        $cidades = Endereco::get('cidade')->unique('cidade');

        $funerarias = Funeraria::all();
        if ($request->data_recebimento) {
            $dataSemEspacos = str_replace(' ', '', $request->data_recebimento);
            $data = explode('-', $dataSemEspacos);
            $dataInicio = Carbon::createFromFormat('d/m/Y', $data[0]);
            $dataFim = Carbon::createFromFormat('d/m/Y', $data[1]);
            $obitos->whereBetween('data_entrada', [$dataInicio, $dataFim]);
        }
        if ($request->data_nascimento) {
            $dataSemEspacos = str_replace(' ', '', $request->data_nascimento);
            $data = explode('-', $dataSemEspacos);
            $dataInicio = Carbon::createFromFormat('d/m/Y', $data[0]);
            $dataFim = Carbon::createFromFormat('d/m/Y', $data[1]);
            $obitos->whereBetween('data_nascimento', [$dataInicio, $dataFim]);
        }
        if ($request->data_obito) {
            $dataSemEspacos = str_replace(' ', '', $request->data_obito);
            $data = explode('-', $dataSemEspacos);
            $dataInicio = Carbon::createFromFormat('d/m/Y', $data[0]);
            $dataFim = Carbon::createFromFormat('d/m/Y', $data[1]);
            $obitos->whereBetween('data_obito', [$dataInicio, $dataFim]);
        }
        if ($request->local_obito) {
            $obitos->where('local_obito', $request->local_obito);
        }
        if ($request->natimorto) {
            $obitos->where('natimorto', $request->natimorto);
        }
        if ($request->sexo) {
            $obitos->where('sexo', $request->sexo);
        }
        if ($request->funeraria) {
            $obitos->where('funeraria_id', $request->funeraria);
        }
        if ($request->estado) {
            $obitos->whereRelation('enderecoCorpo', 'estado', '=', $request->estado);

        }
        if ($request->cidade) {
            $obitos->whereRelation('enderecoCorpo', 'cidade', '=', $request->cidade);
        }

        $obitos = $obitos->get();
        $totalObitos = $obitos->count();
        $dadosLocalOcorrencia = [
            "data" =>
            [
                ['Hospital', $obitos->where('local_obito', 'Hospital')->count()],
                ['Outros estab. saúde', $obitos->where('local_obito', 'Outros estab. saúde')->count()],
                ['Domicílio', $obitos->where('local_obito', 'Domicílio')->count()],
                ['Via pública', $obitos->where('local_obito', 'Via pública')->count()],
                ['Outros', $obitos->where('local_obito', 'Outros')->count()],
                ['Aldeia Indígena', $obitos->where('local_obito', 'Aldeia Indígena')->count()],
                ['Ignorado', $obitos->where('local_obito', 'Ignorado')->count()],
            ],
            "maior" => [],
        ];
        $maiorContagem = 0;
        $registroMaiorContagem = '';

        foreach ($dadosLocalOcorrencia['data'] as $registro) {
            if ($registro[1] > $maiorContagem) {
                $maiorContagem = $registro[1];
                $registroMaiorContagem = $registro[0];
            }
        }

        $dadosLocalOcorrencia['maior'] = [$registroMaiorContagem, $maiorContagem];
        $dadosLocalOcorrencia64 = base64_encode(json_encode($dadosLocalOcorrencia));
        return view('relatorios.relatorio.local-de-ocorrencia', compact('dadosLocalOcorrencia', 'obitos', 'dadosLocalOcorrencia64', 'estados', 'cidades', 'totalObitos', 'funerarias'));
    }

    public function gerarPDF(Request $request)
    {
        $dados = $request->all();
        $pathGovLogo = asset('assets/images/logoestado.png');
        $typeGovLogo = pathinfo($pathGovLogo, PATHINFO_EXTENSION);
        $dataGovLogo = file_get_contents($pathGovLogo);
        $logoGovBase64 = 'data:image/' . $typeGovLogo . ';base64,' . base64_encode($dataGovLogo);

        $pathSivoLogo = asset('assets/images/svo-800.jpg');
        $typeSivoLogo = pathinfo($pathSivoLogo, PATHINFO_EXTENSION);
        $dataSivoLogo = file_get_contents($pathSivoLogo);
        $logoSivoBase64 = 'data:image/' . $typeSivoLogo . ';base64,' . base64_encode($dataSivoLogo);
        $pdf = PDF::loadView('relatorios.template.localocorrencia', compact('logoGovBase64', 'logoSivoBase64', 'dados'));
        return $pdf->stream('relatorio_local_ocorrencia.pdf');
    }
}
