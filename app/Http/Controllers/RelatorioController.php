<?php

namespace App\Http\Controllers;

use App\Models\Corpo;
use App\Models\Endereco;
use App\Models\Entrevista;
use App\Models\Funeraria;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class RelatorioController extends Controller
{

    /**
     * index
     * Função principal que aplica os filtros e reúne os dados de todas as seções do relatório
     *
     * @param  mixed $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $periodo = "Todos os Registros";
        $obitos = Corpo::with(['enderecoCorpo', 'laudoInfo']);
        if ($request->data_recebimento) {
            $dataSemEspacos = str_replace(' ', '', $request->data_recebimento);
            $data = explode('-', $dataSemEspacos);
            $dataInicio = Carbon::createFromFormat('d/m/Y', $data[0]);
            $dataFim = Carbon::createFromFormat('d/m/Y', $data[1]);
            $obitos->whereBetween('data_entrada', [$dataInicio, $dataFim]);
            $periodo = $request->data_recebimento;
        }
        if ($request->data_nascimento) {
            $dataSemEspacos = str_replace(' ', '', $request->data_nascimento);
            $data = explode('-', $dataSemEspacos);
            $dataInicio = Carbon::createFromFormat('d/m/Y', $data[0]);
            $dataFim = Carbon::createFromFormat('d/m/Y', $data[1]);
            $obitos->whereBetween('data_nascimento', [$dataInicio, $dataFim]);
            $periodo = $request->data_nascimento;
        }
        if ($request->data_obito) {
            $dataSemEspacos = str_replace(' ', '', $request->data_obito);
            $data = explode('-', $dataSemEspacos);
            $dataInicio = Carbon::createFromFormat('d/m/Y', $data[0]);
            $dataFim = Carbon::createFromFormat('d/m/Y', $data[1]);
            $obitos->whereBetween('data_obito', [$dataInicio, $dataFim]);
            $periodo = $request->data_obito;
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

        // COMEÇO OBTIOS OCUPAÇÃO
        $obitosOcupacaoBase64 = $this->obitosOcupacao($obitos);

        // DADOS DE ÓBITOS EM RELAÇÃO AO PARTO
        $obitosFaseParto = $this->getObitosFaseParto($obitos);

        // DADOS GERAIS
        $obitos = $obitos->get();
        $totalObitos = count($obitos);
        $estados = Endereco::get('estado')->unique('estado');
        $cidades = Endereco::get('cidade')->unique('cidade');
        $funerarias = Funeraria::all();

        $obitosMasculino = $obitos->where('sexo', 'M')->count();
        $obitosFeminino = $obitos->where('sexo', 'F')->count();

        $dadosObitosSexo = [
            ['Sexo', 'Óbitos'],
            ['Masculino', $obitosMasculino],
            ['Feminino', $obitosFeminino],
        ];

        // DADOS DE ÓBITOS POR MUNICIPIO E BAIRRO
        $dadosObitosMunicipioBairro = $this->getObitosBairroMunicipio($obitos);
        $obitosMunicipio = $dadosObitosMunicipioBairro[0];
        $obitosBairro = $dadosObitosMunicipioBairro[1];

        //  DADOS DE ÓBITOS POR FAIXA ETÁRIA
        $dadosFaixaEtaria = $this->getObitosFaixaEtaria($obitos);
        $obitosFaixaEtaria = $dadosFaixaEtaria[0];
        $maiorFaixaEtaria = $dadosFaixaEtaria[1];

        // DADOS DE ÓBITOS POR MÊS
        $relatorioMeses = $this->getObitosMes($obitos);

        //  DADOS DE ÓBITOS POR LOCAL DE OCORRÊNCIA
        $dadosLocalOcorrencia = $this->getObitosLocalOcorrencia($obitos);

        // DADOS DE ÓBITOS ENCAMINHADOS AO ITEP
        $dadosEncaminhadosITEP = $this->getObitosEncaminhadosAoITEP($obitos);

        // DADOS DE ÓBITOS POR MÉDICO INTERNO/EXTERNO
        $dadosMedicoExternoInterno = $this->getObitosMedicoExternoInterno($obitos);

        // DADOS DE ÓBITOS ENCAMINHADOS A LIGA
        $dadosEncaminhadosLIGA = $this->getObitosEncaminhadosALiga($obitos);

        // DADOS DE ÓBITOS POR SEXO
        $dadosObitosSexoRelatorio = $this->getObitosPorSexo($obitos, $obitosMasculino, $obitosFeminino);

        return view('relatorios.index', compact('periodo', 'obitosFaseParto', 'dadosEncaminhadosLIGA', 'dadosMedicoExternoInterno', 'obitosOcupacaoBase64', 'obitosFaixaEtaria', 'maiorFaixaEtaria', 'estados', 'cidades', 'funerarias', 'dadosObitosSexo', 'dadosObitosSexoRelatorio', 'obitosBairro', 'obitosMunicipio', 'totalObitos', 'relatorioMeses', 'dadosLocalOcorrencia', 'dadosEncaminhadosITEP'));
    }

    /**
     * relatorioObitosPorOcupacao
     * Função que mostra o relatorio de obitos fetais
     * por semana de gestação e media de tipo de parto
     * 
     * @param  mixed $request
     * @return \Illuminate\Contracts\View\View
     */
    public function viewRelatorioObitosFetais(Request $request)
    {
        $periodo = "Todos os Registros";
        $obitos = Corpo::with('enderecoCorpo');
        if ($request->data_recebimento) {
            $dataSemEspacos = str_replace(' ', '', $request->data_recebimento);
            $data = explode('-', $dataSemEspacos);
            $dataInicio = Carbon::createFromFormat('d/m/Y', $data[0]);
            $dataFim = Carbon::createFromFormat('d/m/Y', $data[1]);
            $obitos->whereBetween('data_entrada', [$dataInicio, $dataFim]);
            $periodo = $request->data_recebimento;
        }
        if ($request->data_nascimento) {
            $dataSemEspacos = str_replace(' ', '', $request->data_nascimento);
            $data = explode('-', $dataSemEspacos);
            $dataInicio = Carbon::createFromFormat('d/m/Y', $data[0]);
            $dataFim = Carbon::createFromFormat('d/m/Y', $data[1]);
            $obitos->whereBetween('data_nascimento', [$dataInicio, $dataFim]);
            $periodo = $request->data_nascimento;
        }
        if ($request->data_obito) {
            $dataSemEspacos = str_replace(' ', '', $request->data_obito);
            $data = explode('-', $dataSemEspacos);
            $dataInicio = Carbon::createFromFormat('d/m/Y', $data[0]);
            $dataFim = Carbon::createFromFormat('d/m/Y', $data[1]);
            $obitos->whereBetween('data_obito', [$dataInicio, $dataFim]);
            $periodo = $request->data_obito;
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

        // COMEÇO OBTIOS OCUPAÇÃO

        $obitosOcupacaoBase64 = $this->obitosOcupacao($obitos);

        // DADOS DE ÓBITOS EM RELAÇÃO AO PARTO


        //OBITOS FETAIS
        $obitos = $obitos->with([
            'entrevistaInfo' => function ($query) {
                $query->where('obito_fetal', 1);
            },
            'laudoInfo',
            'entrevistaInfo.corpo'
        ])->whereHas('entrevistaInfo', function ($query) {
            $query->where('obito_fetal', 1);
        })->get();

        $entrevistas_obitosfetais = new Collection();
        //pega entrevistar que tenha obito fetal 
        foreach ($obitos as $obito) {
            $entrevistas_obitosfetais->push($obito->entrevistaInfo);
        }

        $obitosfetais = $obitos;

        // DADOS GERAIS

        $totalObitos = count($obitos);
        $estados = Endereco::get('estado')->unique('estado');
        $cidades = Endereco::get('cidade')->unique('cidade');
        $funerarias = Funeraria::all();


        $obitosMasculino = $obitos->where('sexo', 'M')->count();
        $obitosFeminino = $obitos->where('sexo', 'F')->count();

        $dadosObitosSexo = [
            ['Sexo', 'Óbitos'],
            ['Masculino', $obitosMasculino],
            ['Feminino', $obitosFeminino],
        ];

        // DADOS DE ÓBITOS POR MUNICIPIO E BAIRRO

        $dadosObitosMunicipioBairro = $this->getObitosBairroMunicipio($obitos);
        $obitosMunicipio = $dadosObitosMunicipioBairro[0];
        $obitosBairro = $dadosObitosMunicipioBairro[1];

        //  DADOS DE ÓBITOS POR FAIXA ETÁRIA

        $dadosFaixaEtaria = $this->getObitosFaixaEtaria($obitos);

        $obitosFaixaEtaria = $dadosFaixaEtaria[0];

        $maiorFaixaEtaria = $dadosFaixaEtaria[1];

        // DADOS DE ÓBITOS POR MÊS

        $relatorioMeses = $this->getObitosMes($obitos);

        //  DADOS DE ÓBITOS POR LOCAL DE OCORRÊNCIA

        $dadosLocalOcorrencia = $this->getObitosLocalOcorrencia($obitos);

        // DADOS DE ÓBITOS ENCAMINHADOS AO ITEP

        $dadosEncaminhadosITEP = $this->getObitosEncaminhadosAoITEP($obitos);

        // DADOS DE ÓBITOS POR MÉDICO INTERNO/EXTERNO

        $dadosMedicoExternoInterno = $this->getObitosMedicoExternoInterno($obitos);

        // DADOS DE ÓBITOS ENCAMINHADOS A LIGA

        $dadosEncaminhadosLIGA = $this->getObitosEncaminhadosALiga($obitos);

        // DADOS DE ÓBITOS POR SEXO
        $dadosObitosSexoRelatorio = $this->getObitosPorSexo($obitos, $obitosMasculino, $obitosFeminino);

        $tipos_parto = $this->getObitosPorParto($obitos, $entrevistas_obitosfetais);

        $semanasGestacao = $this->getSemanasGestacao($entrevistas_obitosfetais);

        return view('relatorios.view-obitos-fetais', compact('periodo', 'obitosMasculino', 'obitosFeminino', 'semanasGestacao', 'tipos_parto', 'obitosfetais', 'dadosEncaminhadosLIGA', 'dadosMedicoExternoInterno', 'obitosOcupacaoBase64', 'estados', 'cidades', 'funerarias', 'dadosObitosSexo', 'dadosObitosSexoRelatorio', 'obitosBairro', 'obitosMunicipio', 'totalObitos', 'relatorioMeses', 'dadosLocalOcorrencia', 'dadosEncaminhadosITEP'));
    }

    /**
     * relatorioObitosVindodeFunerarias
     * 
     *
     * @param  mixed $request
     * @return \Illuminate\Contracts\View\View
     */
    public function viewRelatorioObitosFunerarias(Request $request)
    {
        $periodo = "Todos os Registros";
        $obitos = Corpo::with(['enderecoCorpo', 'laudoInfo', 'funeraria', 'entrevistaInfo', 'entrevistaInfo.corpo']);
        if ($request->data_recebimento) {
            $dataSemEspacos = str_replace(' ', '', $request->data_recebimento);
            $data = explode('-', $dataSemEspacos);
            $dataInicio = Carbon::createFromFormat('d/m/Y', $data[0]);
            $dataFim = Carbon::createFromFormat('d/m/Y', $data[1]);
            $obitos->whereBetween('data_entrada', [$dataInicio, $dataFim]);
            $periodo = $request->data_recebimento;
        }
        if ($request->data_nascimento) {
            $dataSemEspacos = str_replace(' ', '', $request->data_nascimento);
            $data = explode('-', $dataSemEspacos);
            $dataInicio = Carbon::createFromFormat('d/m/Y', $data[0]);
            $dataFim = Carbon::createFromFormat('d/m/Y', $data[1]);
            $obitos->whereBetween('data_nascimento', [$dataInicio, $dataFim]);
            $periodo = $request->data_nascimento;
        }
        if ($request->data_obito) {
            $dataSemEspacos = str_replace(' ', '', $request->data_obito);
            $data = explode('-', $dataSemEspacos);
            $dataInicio = Carbon::createFromFormat('d/m/Y', $data[0]);
            $dataFim = Carbon::createFromFormat('d/m/Y', $data[1]);
            $obitos->whereBetween('data_obito', [$dataInicio, $dataFim]);
            $periodo = $request->data_obito;
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

        // COMEÇO OBTIOS OCUPAÇÃO

        $obitosOcupacaoBase64 = $this->obitosOcupacao($obitos);

        // DADOS DE ÓBITOS EM RELAÇÃO AO PARTO


        //OBITOS FETAIS
        $obitos = $obitos->get();

        $entrevistas_obitosfetais = new Collection();
        foreach ($obitos as $obito) {
            if ($obito->entrevistaInfo && $obito->entrevistaInfo->obito_fetal == 1) {
                $entrevistas_obitosfetais->push($obito->entrevistaInfo);
            }
        }

        $obitosfetais = $obitos->filter(function ($obito) {
            return $obito->entrevistaInfo && $obito->entrevistaInfo->obito_fetal === 1;
        });

        // DADOS GERAIS

        $totalObitos = count($obitos);
        $estados = Endereco::get('estado')->unique('estado');
        $cidades = Endereco::get('cidade')->unique('cidade');
        $funerarias = Funeraria::all();


        $obitosMasculino = $obitos->where('sexo', 'M')->count();
        $obitosFeminino = $obitos->where('sexo', 'F')->count();

        $dadosObitosSexo = [
            ['Sexo', 'Óbitos'],
            ['Masculino', $obitosMasculino],
            ['Feminino', $obitosFeminino],
        ];

        // DADOS DE ÓBITOS POR MUNICIPIO E BAIRRO

        $dadosObitosMunicipioBairro = $this->getObitosBairroMunicipio($obitos);
        $obitosMunicipio = $dadosObitosMunicipioBairro[0];
        $obitosBairro = $dadosObitosMunicipioBairro[1];

        //  DADOS DE ÓBITOS POR FAIXA ETÁRIA

        $dadosFaixaEtaria = $this->getObitosFaixaEtaria($obitos);

        $obitosFaixaEtaria = $dadosFaixaEtaria[0];

        $maiorFaixaEtaria = $dadosFaixaEtaria[1];

        // DADOS DE ÓBITOS POR MÊS

        $relatorioMeses = $this->getObitosMes($obitos);

        //  DADOS DE ÓBITOS POR LOCAL DE OCORRÊNCIA

        $dadosLocalOcorrencia = $this->getObitosLocalOcorrencia($obitos);

        // DADOS DE ÓBITOS ENCAMINHADOS AO ITEP

        $dadosEncaminhadosITEP = $this->getObitosEncaminhadosAoITEP($obitos);

        // DADOS DE ÓBITOS POR MÉDICO INTERNO/EXTERNO

        $dadosMedicoExternoInterno = $this->getObitosMedicoExternoInterno($obitos);

        // DADOS DE ÓBITOS ENCAMINHADOS A LIGA

        $dadosEncaminhadosLIGA = $this->getObitosEncaminhadosALiga($obitos);

        // DADOS DE ÓBITOS POR SEXO
        $dadosObitosSexoRelatorio = $this->getObitosPorSexo($obitos, $obitosMasculino, $obitosFeminino);

        $tipos_parto = $this->getObitosPorParto($obitos, $entrevistas_obitosfetais);
        $semanasGestacao = $this->getSemanasGestacao($entrevistas_obitosfetais);

        //OBITOS RELACIONADOS A FUNERARIAS E SEU TOTAL  
        $obitosFunerarias = $this->getObitosVindoFuneraria($obitos);
        $obitosFunerariasDecode = json_decode(base64_decode($obitosFunerarias));
        $totalObitosVinculadosFunerarias = 0;
        foreach ($obitosFunerariasDecode as $key => $value) {
            $totalObitosVinculadosFunerarias += $value[1];
        }

        //OBITOS RELACIONADOS A FUNERARIAS E SEUS MEIOS DE TRANSPORTE
        $obitosPorTransporte = $this->getObitosTipoTransporte($obitos);
        $obitosPorTransporteDecode = json_decode(base64_decode($obitosPorTransporte));

        $obitos = base64_encode(json_encode($obitos));
        return view('relatorios.view-obitos-funerarias', compact('totalObitosVinculadosFunerarias', 'obitosPorTransporte', 'obitos', 'obitosFunerarias', 'periodo', 'obitosMasculino', 'obitosFeminino', 'semanasGestacao', 'tipos_parto', 'obitosfetais', 'dadosEncaminhadosLIGA', 'dadosMedicoExternoInterno', 'obitosOcupacaoBase64', 'estados', 'cidades', 'funerarias', 'dadosObitosSexo', 'dadosObitosSexoRelatorio', 'obitosBairro', 'obitosMunicipio', 'totalObitos', 'relatorioMeses', 'dadosLocalOcorrencia', 'dadosEncaminhadosITEP'));
    }

    /**
     * relatorioGeral
     * Função que gera o PDF do relatório geral utilizando o DOMPDF
     *
     * @param  mixed $request
     * @return \Illuminate\Http\Response
     */
    public function relatorioGeral(Request $request)
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
        $pdf = PDF::loadView('relatorios.template.geral', compact('logoGovBase64', 'logoSivoBase64', 'dados'));
        return $pdf->stream('relatorio_geral.pdf');
    }

    /**
     * relatorioObitoFetal
     * Função que gera o PDF do relatório de óbitos por ocupação utilizando o DOMPDF
     *
     * @param  mixed $request
     * @return \Illuminate\Http\Response
     */
    public function relatorioObitosFetais(Request $request)
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

        $pdf = PDF::loadView('relatorios.template.obito-fetal', compact('logoGovBase64', 'logoSivoBase64', 'dados'));
        return $pdf->stream('relatorio_obitos_fetais.pdf');
    }

    /**
     * relatorioObitosFunerarias
     * Função que gera o PDF do relatório de Obitos Funerarias o DOMPDF
     *
     * @param  mixed $request
     * @return \Illuminate\Http\Response
     */
    public function relatorioObitosFunerarias(Request $request)
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

        $pdf = PDF::loadView('relatorios.template.obito-funerarias', compact('logoGovBase64', 'logoSivoBase64', 'dados'));
        return $pdf->stream('relatorio_obitos_funerarias.pdf');
    }

    /**
     * getObitosBairroMunicipio
     * Função que retorna os obitos por bairro e municipio
     *
     * @param  mixed $obitos
     * @return array base64 JSON
     */
    public function getObitosBairroMunicipio($obitos)
    {
        $obitosMunicipio = [];
        $obitosBairro = [];

        foreach ($obitos as $obito) {
            $municipioNome = $obito->enderecoCorpo->cidade;
            $municipioTratado = strtolower(str_replace(' ', '', tirarAcentos($municipioNome)));

            if (!array_key_exists($municipioTratado, $obitosMunicipio)) {
                $obitosMunicipio[$municipioTratado] = ['nome' => $municipioNome, 'obitos' => 0];
            }

            $obitosMunicipio[$municipioTratado]['obitos']++;

            $bairroNome = $obito->enderecoCorpo->bairro;
            $bairroTratado = strtolower(str_replace(' ', '', tirarAcentos($bairroNome)));

            if (!array_key_exists($bairroTratado, $obitosBairro)) {
                $obitosBairro[$bairroTratado] = ['nome' => $bairroNome, 'obitos' => 0];
            }

            $obitosBairro[$bairroTratado]['obitos']++;
        }

        $obitosMunicipio = base64_encode(json_encode($obitosMunicipio));
        $obitosBairro = base64_encode(json_encode($obitosBairro));

        return [$obitosMunicipio, $obitosBairro];
    }

    /**
     * getObitosLocalOcorrencia
     * Função que retorna os obitos por local de ocorrência
     *
     * @param  mixed $obitos
     * @return string base64 JSON
     */
    public function getObitosLocalOcorrencia($obitos)
    {
        $locais = [
            'Hospital',
            'Outros estab. saúde',
            'Domicílio',
            'Via pública',
            'Outros',
            'Aldeia Indígena',
            'Ignorado'
        ];

        $dadosLocalOcorrencia = collect($locais)->map(function ($local) use ($obitos) {
            return [$local, $obitos->where('local_obito', $local)->count()];
        });

        $dadosLocalOcorrencia = $dadosLocalOcorrencia->sortByDesc(1);
        $maiorRegistro = $dadosLocalOcorrencia->first();

        $dadosLocalOcorrencia = [
            "data" => $dadosLocalOcorrencia->toArray(),
            "maior" => $maiorRegistro,
        ];

        return base64_encode(json_encode($dadosLocalOcorrencia));
    }

    /**
     * getObitosPorSexo
     * Função que retorna os dados de óbitos por sexo
     *
     * @param  mixed $obitos
     * @return string base64 JSON
     */
    public function getObitosPorSexo($obitos, $obitosMasculino, $obitosFeminino)
    {
        $dadosObitosSexoRelatorio = [
            "data" => [
                'masculino' => ['label' => 'Masculino', 'value' => $obitosMasculino],
                'feminino' => ['label' => 'Feminino', 'value' => $obitosFeminino],
            ],
            "maior" => $obitosMasculino > $obitosFeminino ? 'masculino' : 'feminino',
        ];
        $dadosObitosSexoRelatorio = base64_encode(json_encode($dadosObitosSexoRelatorio));

        return $dadosObitosSexoRelatorio;
    }

    /**
     * getObitosEncaminhadosAoITEP
     * Função que retorna os óbitos encaminhados para o ITEP
     *
     * @param  mixed $obitos
     * @return string base64 JSON
     */
    public function getObitosEncaminhadosAoITEP($obitos)
    {
        $contagem = $obitos->countBy(function ($obito) {
            return $obito->encaminhar_itep ? 'encaminhados' : 'nao_encaminhados';
        });

        $dadosEncaminhadosITEP = [
            "data" => [
                "nao_encaminhados" => ['label' => 'Não encaminhados para o ITEP', 'value' => $contagem->get('nao_encaminhados', 0)],
                "encaminhados" => ['label' => 'Encaminhados para o ITEP', 'value' => $contagem->get('encaminhados', 0)],
            ],
            "maior" => $contagem->get('encaminhados', 0) > $contagem->get('nao_encaminhados', 0) ? 'encaminhados' : 'nao_encaminhados',
        ];

        return base64_encode(json_encode($dadosEncaminhadosITEP));
    }

    /**
     * getObitosFaseParto
     * Função que retorna os óbitos em relação a fase do parto (Antes|Durante|Depois)
     *
     * @param  mixed $obitos
     * @return string
     */
    public function getObitosFaseParto($obitos)
    {
        $obitosPorParto = Entrevista::selectRaw('morte_relacao_parto, count(*) as total')
            ->whereNotNull('morte_relacao_parto')
            ->whereHas('corpo', function ($query) use ($obitos) {
                $query->addNestedWhereQuery($obitos->getQuery());
            })
            ->groupBy('morte_relacao_parto')
            ->orderByDesc('total')
            ->get();

        return base64_encode(json_encode($obitosPorParto->toArray()));
    }

    /**
     * getObitosEncaminhadosALiga
     * Função que retorna os óbitos encaminhados para a LIGA
     *
     * @param  mixed $obitos
     * @return string base64 JSON
     */
    public function getObitosEncaminhadosALiga($obitos)
    {
        $contagem = $obitos->countBy(function ($obito) {
            return $obito->encaminhar_liga ? 'encaminhados' : 'nao_encaminhados';
        });

        $dadosEncaminhadosLIGA = [
            "data" => [
                "nao_encaminhados" => ['label' => 'Não encaminhados para a LIGA', 'value' => $contagem->get('nao_encaminhados', 0)],
                "encaminhados" => ['label' => 'Encaminhados para a LIGA', 'value' => $contagem->get('encaminhados', 0)],
            ],
            "maior" => $contagem->get('encaminhados', 0) > $contagem->get('nao_encaminhados', 0) ? 'encaminhados' : 'nao_encaminhados',
        ];

        return base64_encode(json_encode($dadosEncaminhadosLIGA));
    }

    /**
     * getObitosMedicoExternoInterno
     * Função que retorna os dados de óbitos por médico externo
     *
     * @param  mixed $obitos
     * @return string
     */
    public function getObitosMedicoExternoInterno($obitos)
    {
        $contagem = $obitos->countBy(function ($obito) {
            return $obito->medico_externo ? 'externo' : 'interno';
        });

        $dadosMedicoExterno = [
            "data" => [
                "interno" => ['label' => 'Médico interno', 'value' => $contagem->get('interno', 0)],
                "externo" => ['label' => 'Médico externo', 'value' => $contagem->get('externo', 0)],
            ],
            "maior" => $contagem->get('externo', 0) > $contagem->get('interno', 0) ? 'externo' : 'interno',
        ];

        return base64_encode(json_encode($dadosMedicoExterno));
    }

    /**
     * getObitosMes
     * Função que retorna os óbitos por mês
     *
     * @param  mixed $obitos
     * @return string base64 JSON
     */
    public function getObitosMes($obitos)
    {
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

        foreach ($obitos as $corpo) {
            $date = Carbon::parse($corpo->data_entrada);
            $nomeMes = ucfirst($date->translatedFormat('F'));
            $relatorioMeses['data'][$nomeMes] += 1;
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
        $relatorioMeses = base64_encode(json_encode($relatorioMeses));

        return $relatorioMeses;
    }

    /**
     * obitosOcupacao
     * Função que retorna os óbitos por ocupação
     *
     * @param  mixed $obitos
     * @return string base64 JSON
     */
    public function obitosOcupacao($obitos)
    {
        $obitosOcupacao = Entrevista::selectRaw('ocupacao_id, count(*) as total')
            ->whereHas('corpo', function ($query) use ($obitos) {
                $query->addNestedWhereQuery($obitos->getQuery());
            })
            ->groupBy('ocupacao_id')
            ->orderByDesc('total')
            ->with('ocupacao')
            ->get()
            ->map(function ($item) {
                $item->ocupacao_nome = $item->ocupacao_id
                    ? $item->ocupacao->ds_ocupacao
                    : "Sem ocupação";
                return $item;
            })
            ->sortByDesc('total')
            ->take(5);

        return base64_encode(json_encode($obitosOcupacao->toArray()));
    }

    /**
     * getObitosFaixaEtaria
     * Função que retorna os óbitos por faixa etária
     *
     * @param  mixed $obitos
     * @return array base64 JSON
     */
    public function getObitosFaixaEtaria($obitos)
    {
        $faixasEtarias = [
            ["faixaetaria" => "85+", "homens" => 0, "mulheres" => 0],
            ["faixaetaria" => "80-84", "homens" => 0, "mulheres" => 0],
            ["faixaetaria" => "75-79", "homens" => 0, "mulheres" => 0],
            ["faixaetaria" => "70-74", "homens" => 0, "mulheres" => 0],
            ["faixaetaria" => "65-69", "homens" => 0, "mulheres" => 0],
            ["faixaetaria" => "60-64", "homens" => 0, "mulheres" => 0],
            ["faixaetaria" => "55-59", "homens" => 0, "mulheres" => 0],
            ["faixaetaria" => "50-54", "homens" => 0, "mulheres" => 0],
            ["faixaetaria" => "45-49", "homens" => 0, "mulheres" => 0],
            ["faixaetaria" => "40-44", "homens" => 0, "mulheres" => 0],
            ["faixaetaria" => "35-39", "homens" => 0, "mulheres" => 0],
            ["faixaetaria" => "30-34", "homens" => 0, "mulheres" => 0],
            ["faixaetaria" => "25-29", "homens" => 0, "mulheres" => 0],
            ["faixaetaria" => "20-24", "homens" => 0, "mulheres" => 0],
            ["faixaetaria" => "15-19", "homens" => 0, "mulheres" => 0],
            ["faixaetaria" => "10-14", "homens" => 0, "mulheres" => 0],
            ["faixaetaria" => "5-9", "homens" => 0, "mulheres" => 0],
            ["faixaetaria" => "0-4", "homens" => 0, "mulheres" => 0],
        ];

        foreach ($obitos as $obito) {
            $dataNascimento = Carbon::parse($obito->laudoInfo->data_nascimento ?? $obito->data_nascimento);
            $idade = $dataNascimento->diffInYears(Carbon::parse($obito->data_obito));

            foreach ($faixasEtarias as &$faixa) {
                if ($this->idadeDentroFaixa($idade, $faixa['faixaetaria'])) {
                    $faixa[$obito->sexo == 'F' ? 'mulheres' : 'homens']++;
                    break;
                }
            }
        }

        $faixasEtarias = array_filter($faixasEtarias, fn($faixa) => $faixa['homens'] > 0 || $faixa['mulheres'] > 0);
        $faixasEtarias = array_reverse($faixasEtarias);

        $classificacaoEtaria = [
            "0-4" => "Jovem",
            "5-9" => "Jovem",
            "10-14" => "Jovem",
            "15-19" => "Jovem",
            "20-24" => "Adulta",
            "25-29" => "Adulta",
            "30-34" => "Adulta",
            "35-39" => "Adulta",
            "40-44" => "Adulta",
            "45-49" => "Adulta",
            "50-54" => "Adulta",
            "55-59" => "Adulta",
            "60-64" => "Idosa",
            "65-69" => "Idosa",
            "70-74" => "Idosa",
            "75-79" => "Idosa",
            "80-84" => "Idosa",
            "85+" => "Idosa",
        ];

        $maiorFaixaEtaria = collect($faixasEtarias)->sortByDesc(function ($faixa) {
            return $faixa['homens'] + $faixa['mulheres'];
        })->first();

        $maiorFaixa = [
            'faixaetaria' => $maiorFaixaEtaria['faixaetaria'] ?? '',
            'homens' => $maiorFaixaEtaria['homens'] ?? '',
            'mulheres' => $maiorFaixaEtaria['mulheres'] ?? '',
            'soma' => ($maiorFaixaEtaria['homens'] ?? 0) + ($maiorFaixaEtaria['mulheres'] ?? 0),
            'tipo' => $classificacaoEtaria[$maiorFaixaEtaria['faixaetaria']] ?? '',
        ];

        return [base64_encode(json_encode($faixasEtarias)), base64_encode(json_encode($maiorFaixa))];
    }

    private function idadeDentroFaixa(int $idade, string $faixa): bool
    {
        switch ($faixa) {
            case "85+":
                return $idade > 85;
            case "80-84":
                return $idade >= 80 && $idade <= 84;
            case "75-79":
                return $idade >= 75 && $idade <= 79;
            case "70-74":
                return $idade >= 70 && $idade <= 74;
            case "65-69":
                return $idade >= 65 && $idade <= 69;
            case "60-64":
                return $idade >= 60 && $idade <= 64;
            case "55-59":
                return $idade >= 55 && $idade <= 59;
            case "50-54":
                return $idade >= 50 && $idade <= 54;
            case "45-49":
                return $idade >= 45 && $idade <= 49;
            case "40-44":
                return $idade >= 40 && $idade <= 44;
            case "35-39":
                return $idade >= 35 && $idade <= 39;
            case "30-34":
                return $idade >= 30 && $idade <= 34;
            case "25-29":
                return $idade >= 25 && $idade <= 29;
            case "20-24":
                return $idade >= 20 && $idade <= 24;
            case "15-19":
                return $idade >= 15 && $idade <= 19;
            case "10-14":
                return $idade >= 10 && $idade <= 14;
            case "5-9":
                return $idade >= 5 && $idade <= 9;
            case "0-4":
                return $idade >= 0 && $idade <= 4;
            default:
                return false;
        }
    }

    /**
     * getObitosPorParto
     * Função que retorna os óbitos em relação ao parto
     *
     * @param  mixed $entrevistas_obitosfetais
     * @return string
     */
    public function getObitosporParto($obitos, $entrevistas_obitos_fetais)
    {

        $totalObitos = $obitos->count();
        $obitosTipoParto = [
            0 => ["tipoparto" => "Vaginal", "homens" => 0, "mulheres" => 0, "total" => 0],
            1 => ["tipoparto" => "Cesaria", "homens" => 0, "mulheres" => 0, "total" => 0],
            2 => ["tipoparto" => "Ignorado", "homens" => 0, "mulheres" => 0, "total" => 0],
        ];

        foreach ($entrevistas_obitos_fetais as $key => $obitofetal) {
            switch ($obitofetal) {
                case $obitofetal->tipo_de_parto == 'Vaginal':
                    $obitosTipoParto[0][$obitofetal->corpo->sexo == 'F' ? 'mulheres' : 'homens'] += 1;
                    $obitosTipoParto[0]['total'] += 1;
                    break;
                case $obitofetal->tipo_de_parto == 'Cesaria':
                    $obitosTipoParto[1][$obitofetal->corpo->sexo == 'F' ? 'mulheres' : 'homens'] += 1;
                    $obitosTipoParto[1]['total'] += 1;
                    break;
                case $obitofetal->tipo_de_parto == 'Ignorado':
                    $obitosTipoParto[2][$obitofetal->corpo->sexo == 'F' ? 'mulheres' : 'homens'] += 1;
                    $obitosTipoParto[2]['total'] += 1;
                    break;
            }
        }
        $obitosTipoParto = base64_encode(json_encode($obitosTipoParto));
        return $obitosTipoParto;
    }

    /**
     * getSemanasGestacao
     * Função que retorna as semanas de gestacao de cada
     * obito fetal
     *
     * @param  mixed $obitos
     * @return string
     */
    public function getSemanasGestacao($entrevistas_obitosfetais)
    {
        $obitosSemanasGestacao = [
            0 => ["semanasgestacao" => "0-4", "homens" => 0, "mulheres" => 0, "total" => 0],
            1 => ["semanasgestacao" => "5-8", "homens" => 0, "mulheres" => 0, "total" => 0],
            2 => ["semanasgestacao" => "9-12", "homens" => 0, "mulheres" => 0, "total" => 0],
            3 => ["semanasgestacao" => "13-16", "homens" => 0, "mulheres" => 0, "total" => 0],
            4 => ["semanasgestacao" => "17-20", "homens" => 0, "mulheres" => 0, "total" => 0],
            5 => ["semanasgestacao" => "21-24", "homens" => 0, "mulheres" => 0, "total" => 0],
            6 => ["semanasgestacao" => "25-28", "homens" => 0, "mulheres" => 0, "total" => 0],
            7 => ["semanasgestacao" => "29-32", "homens" => 0, "mulheres" => 0, "total" => 0],
            8 => ["semanasgestacao" => "33-36", "homens" => 0, "mulheres" => 0, "total" => 0],
            9 => ["semanasgestacao" => "37-40", "homens" => 0, "mulheres" => 0, "total" => 0],
            10 => ["semanasgestacao" => "40+", "homens" => 0, "mulheres" => 0, "total" => 0],
        ];

        // CONCERTAR SEPARAÇÃO POR SEXO
        foreach ($entrevistas_obitosfetais as $key => $obitofetal) {
            switch (true) {
                case $obitofetal->tempo_gestacao <= 4:
                    $obitosSemanasGestacao[0][$obitofetal->corpo->sexo == 'F' ? 'mulheres' : 'homens'] += 1;
                    $obitosSemanasGestacao[0]['total'] += 1;
                    break;
                case $obitofetal->tempo_gestacao <= 8 && $obitofetal->tempo_gestacao >= 5:
                    $obitosSemanasGestacao[1][$obitofetal->corpo->sexo == 'F' ? 'mulheres' : 'homens'] += 1;
                    $obitosSemanasGestacao[1]['total'] += 1;
                    break;
                case $obitofetal->tempo_gestacao <= 12 && $obitofetal->tempo_gestacao >= 9:
                    $obitosSemanasGestacao[2][$obitofetal->corpo->sexo == 'F' ? 'mulheres' : 'homens'] += 1;
                    $obitosSemanasGestacao[2]['total'] += 1;
                    break;
                case $obitofetal->tempo_gestacao <= 16 && $obitofetal->tempo_gestacao >= 13:
                    $obitosSemanasGestacao[3][$obitofetal->corpo->sexo == 'F' ? 'mulheres' : 'homens'] += 1;
                    $obitosSemanasGestacao[3]['total'] += 1;
                    break;
                case $obitofetal->tempo_gestacao <= 20 && $obitofetal->tempo_gestacao >= 17:
                    $obitosSemanasGestacao[4][$obitofetal->corpo->sexo == 'F' ? 'mulheres' : 'homens'] += 1;
                    $obitosSemanasGestacao[4]['total'] += 1;
                    break;
                case $obitofetal->tempo_gestacao <= 24 && $obitofetal->tempo_gestacao >= 21:
                    $obitosSemanasGestacao[5][$obitofetal->corpo->sexo == 'F' ? 'mulheres' : 'homens'] += 1;
                    $obitosSemanasGestacao[5]['total'] += 1;
                    break;
                case $obitofetal->tempo_gestacao <= 28 && $obitofetal->tempo_gestacao >= 25:
                    $obitosSemanasGestacao[6][$obitofetal->corpo->sexo == 'F' ? 'mulheres' : 'homens'] += 1;
                    $obitosSemanasGestacao[6]['total'] += 1;
                    break;
                case $obitofetal->tempo_gestacao <= 32 && $obitofetal->tempo_gestacao >= 29:
                    $obitosSemanasGestacao[7][$obitofetal->corpo->sexo == 'F' ? 'mulheres' : 'homens'] += 1;
                    $obitosSemanasGestacao[7]['total'] += 1;
                    break;
                case $obitofetal->tempo_gestacao <= 36 && $obitofetal->tempo_gestacao >= 33:
                    $obitosSemanasGestacao[8][$obitofetal->corpo->sexo == 'F' ? 'mulheres' : 'homens'] += 1;
                    $obitosSemanasGestacao[8]['total'] += 1;
                    break;
                case $obitofetal->tempo_gestacao <= 40 && $obitofetal->tempo_gestacao >= 37:
                    $obitosSemanasGestacao[9][$obitofetal->corpo->sexo == 'F' ? 'mulheres' : 'homens'] += 1;
                    $obitosSemanasGestacao[9]['total'] += 1;
                    break;
                case $obitofetal->tempo_gestacao >= 40:
                    $obitosSemanasGestacao[10][$obitofetal->corpo->sexo == 'F' ? 'mulheres' : 'homens'] += 1;
                    $obitosSemanasGestacao[10]['total'] += 1;
                    break;
            }
        }

        $arrayTratado = array_filter($obitosSemanasGestacao, function ($obito) {
            return $obito['homens'] != 0 || $obito['mulheres'] != 0;
        });

        $newArray = array();

        foreach ($arrayTratado as $row) {
            $ageRange = $row["semanasgestacao"];
            $menCount = $row["homens"];
            $womenCount = $row["mulheres"];
            $total = $row["total"];

            $newRow = array($ageRange, $menCount, $womenCount, $total);
            array_push($newArray, $newRow);
        }

        $newArray = array_map(function ($item) {
            if ($item[1] == 0) {
                $item[1] = null;
            }
            if ($item[2] == 0) {
                $item[2] = null;
            }
            return $item;
        }, $newArray);



        $obitosSemanasGestacao = base64_encode(json_encode($newArray));

        return $obitosSemanasGestacao;
    }

    /**
     * getObitosVindoFuneraria
     * Função que retorna os óbitos por funeraria
     *
     * @param  mixed $obitos
     * @return string base64 JSON
     */
    public function getObitosVindoFuneraria($obitos)
    {
        $obitofunerarias = $obitos->where('meio_transporte', 'Funeraria');

        //pega os nomes das funerarias com obitos vindo de funerarias
        $total_por_funeraria = [];
        foreach ($obitofunerarias as $obitofuneraria) {
            $funeraria_nome = $obitofuneraria->funeraria->nome ?? 'Nao informado';

            if (array_key_exists($funeraria_nome, $total_por_funeraria)) {
                $total_por_funeraria[$funeraria_nome] += 1;
            } else {
                $total_por_funeraria[$funeraria_nome] = 1;
            }
        }

        $arrayTratado = array_filter($total_por_funeraria, function ($obito) {
            return $obito != 0;
        });
        $newArray = array();

        foreach ($arrayTratado as $funeraria_nome => $total_por_funeraria) {
            $ageRange = $funeraria_nome;
            $funCount = $total_por_funeraria;

            $newRow = array($ageRange, $funCount);
            array_push($newArray, $newRow);
        }

        $newArray = array_map(function ($item) {
            if ($item[1] == 0) {
                $item[1] = null;
            }
            return $item;
        }, $newArray);
        $obitosVindoFuneraria = base64_encode(json_encode($newArray));
        return $obitosVindoFuneraria;
    }

    public function getObitosTipoTransporte($obitos)
    {

        $obitosPorTransporte = [
            0 => ["meiotransporte" => "Funeraria", "homens" => 0, "mulheres" => 0],
            1 => ["meiotransporte" => "SAMU", "homens" => 0, "mulheres" => 0],
            2 => ["meiotransporte" => "Outros", "homens" => 0, "mulheres" => 0],
        ];

        foreach ($obitos as $obito) {
            switch ($obito->meio_transporte) {
                case 'Funeraria':
                    $obitosPorTransporte[0][$obito->sexo == 'F' ? 'mulheres' : 'homens'] += 1;
                    break;
                case 'SAMU':
                    $obitosPorTransporte[1][$obito->sexo == 'F' ? 'mulheres' : 'homens'] += 1;
                    break;
                case 'Outros':
                    $obitosPorTransporte[2][$obito->sexo == 'F' ? 'mulheres' : 'homens'] += 1;
                    break;
            }
        }

        $arrayTratado = array_filter($obitosPorTransporte, function ($obito) {
            return $obito['homens'] != 0 || $obito['mulheres'] != 0;
        });

        $newArray = array();

        foreach ($arrayTratado as $row) {
            $ageRange = $row["meiotransporte"];
            $menCount = $row["homens"];
            $womenCount = $row["mulheres"];
            $total = $menCount + $womenCount;

            $newRow = array($ageRange, $menCount, $womenCount, $total);
            array_push($newArray, $newRow);
        }

        $newArray = array_map(function ($item) {
            if ($item[1] == 0) {
                $item[1] = null;
            }
            if ($item[2] == 0) {
                $item[2] = null;
            }
            return $item;
        }, $newArray);

        $newArray = base64_encode(json_encode($newArray));
        return $newArray;
    }
}
