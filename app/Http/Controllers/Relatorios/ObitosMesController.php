<?php

namespace App\Http\Controllers\Relatorios;

use App\Http\Controllers\Controller;
use App\Models\Corpo;
use App\Models\Endereco;
use App\Models\Funeraria;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ObitosMesController extends Controller
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

        $relatorioMeses = [
            "data" => [
                "Janeiro" => 0,
                "Fevereiro" => 0,
                "Março" => 0,
                "Abril" => 0,
                "Maio" => 0,
                "Junho" => 0,
                "Julho" => 0,
                "Agosto" => 0,
                "Setembro" => 0,
                "Outubro" => 0,
                "Novembro" => 0,
                "Dezembro" => 0,
            ],
            "maior" => "",
            "maior2" => "",
            "menor" => "",
        ];
        for ($i = 0; $i < 12; $i++) {
            foreach ($obitos as $key => $corpo) {
                $date = Carbon::parse($corpo->data_entrada);
                $nomeMes = ucfirst($date->translatedFormat('F'));
                if ($date->month == $i + 1) {
                    $relatorioMeses['data'][$nomeMes] += 1;
                }
            }

        }
        $maior = 0;
        $maior2 = 0;
        $menor = PHP_INT_MAX;
        $maior_mes = '';
        $maior2_mes = '';
        $menor_mes = '';

        foreach ($relatorioMeses['data'] as $mes => $valor) {
            if ($valor > $maior) {
                $maior2 = $maior;
                $maior2_mes = $maior_mes;
                $maior = $valor;
                $maior_mes = $mes;
            } elseif ($valor > $maior2) {
                $maior2 = $valor;
                $maior2_mes = $mes;
            }

            if ($mes > $maior_mes && ($valor < $menor || $menor_mes == '')) {
                $menor = $valor;
                $menor_mes = $mes;
            }
        }

        $relatorioMeses['maior'] = $maior_mes;
        $relatorioMeses['maior2'] = $maior2_mes;
        $relatorioMeses['menor'] = $menor_mes;

        return view('relatorios.relatorio.obitos-mes', compact('relatorioMeses', 'obitos', 'estados', 'cidades', 'totalObitos', 'funerarias'));
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
        $pdf = PDF::loadView('relatorios.template.obitosmes', compact('logoGovBase64', 'logoSivoBase64', 'dados'));
        return $pdf->stream('relatorio_obitos_mes.pdf');
    }
}
