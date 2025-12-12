<?php

namespace App\Http\Controllers;

use App\Models\Corpo;
use App\Models\Entrevista;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ApiGraficoController extends Controller
{
    /**
     * gerarGraficoMeses
     * Função que gera o gráfico dos meses no padrão do Google Charts
     *
     * @param  mixed $request
     * @return \Illuminate\Http\Response
     */
    public function gerarGraficoMeses(Request $request)
    {
        if (!$request->hasValidSignature()) {
            abort(401);
        }
    
        $obitos = Corpo::with('enderecoCorpo');
        $this->applyFilters($request, $obitos);
        $obitos = $obitos->get();
    
        // Obtém os últimos 12 meses
        $periodo = collect();
        for ($i = 11; $i >= 0; $i--) {
            $data = now()->subMonths($i);
            $mesAno = strtolower($data->translatedFormat('F Y')); // Ex: "março 2024"
    
            $periodo->push([
                'mes_ano' => $mesAno, // Nome do mês em minúsculo + ano
                'quantidade' => 0
            ]);
        }
    
        // Agrupa os óbitos corretamente por "mês ano" (em minúsculo para garantir a correspondência)
        $dadosAgrupados = $obitos->groupBy(fn ($item) => strtolower(Carbon::parse($item->created_at)->translatedFormat('F Y')))
            ->mapWithKeys(fn ($group, $mesAno) => [$mesAno => $group->count()]);
    
        // Atualiza os valores dentro do período definido
        $resultadoFinal = $periodo->map(function ($item) use ($dadosAgrupados) {
            return [
                ucfirst($item['mes_ano']), // Exibe com a primeira letra maiúscula
                $dadosAgrupados[$item['mes_ano']] ?? 0 // Pega o valor se existir, senão coloca 0
            ];
        })->values();
    
        return response()->json($resultadoFinal);
    }
    
    
    
    

    /**
     * gerarGraficoMesesArea
     * Função que retorna o gráfico dos meses em area para o padrão do Google Charts
     *
     * @param  mixed $request
     * @return \Illuminate\Http\Response
     */
    public function gerarGraficoMesesArea(Request $request)
    {
        if (!$request->hasValidSignature()) {
            abort(401);
        }

        $obitos = Corpo::with('enderecoCorpo');
        $this->applyFilters($request, $obitos);

        $anoAtual = Carbon::now()->year;
        $anoPassado = Carbon::now()->subYear()->year;

        $obitos = $obitos->get();

        $relatorioMeses = $this->getMonthlyReportWithComparison($obitos, $anoAtual, $anoPassado);

        return response()->json($relatorioMeses);
    }
    private function getMonthlyReportWithComparison($obitos, $anoAtual, $anoPassado)
    {
        $months = [
            "Janeiro",
            "Fevereiro",
            "Março",
            "Abril",
            "Maio",
            "Junho",
            "Julho",
            "Agosto",
            "Setembro",
            "Outubro",
            "Novembro",
            "Dezembro"
        ];

        return collect($months)->map(function ($month, $index) use ($obitos, $anoAtual, $anoPassado) {
            $monthIndex = $index + 1;
            $currentMonthCount = $obitos->filter(function ($item) use ($monthIndex, $anoAtual) {
                $createdAt = Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at);
                return $createdAt->month == $monthIndex && $createdAt->year == $anoAtual;
            })->count();

            $previousMonthCount = $obitos->filter(function ($item) use ($monthIndex, $anoPassado) {
                $createdAt = Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at);
                return $createdAt->month == $monthIndex && $createdAt->year == $anoPassado;
            })->count();

            return [$month, $currentMonthCount, $previousMonthCount];
        })->values()->all();
    }

    /**
     * gerarGraficoOcupacao
     * Função que retorna os dados do gráfico de ocupações no padrão do Google Charts
     *
     * @param  mixed $request
     * @return \Illuminate\Http\Response
     */
    public function gerarGraficoOcupacao(Request $request)
    {
        if (!$request->hasValidSignature()) {
            abort(401);
        }

        $filtro = Corpo::query();
        $this->applyFilters($request, $filtro);

        $obitos = Entrevista::groupBy('ocupacao_id')
            ->selectRaw('ocupacao_id, count(*) as total')
            ->orderByDesc('total')
            ->whereHas('corpo', function ($q) use ($filtro) {
                $q->addNestedWhereQuery($filtro->getQuery());
            })
            ->with('ocupacao')
            ->get();

        $obitosGrafico = $obitos->map(function ($item) {
            $ocupacao_nome = $item->ocupacao_id ? $item->ocupacao->ds_ocupacao : "Sem ocupação";
            return [$ocupacao_nome, $item->total];
        })->take(5);

        return response()->json($obitosGrafico);
    }

    /**
     * gerarGraficoFaixaEtaria
     * Função que retorna o gráfico de faixa etária o padrão do Google Charts
     *
     * @param  mixed $request
     * @return \Illuminate\Http\Response
     */
    public function gerarGraficoFaixaEtaria(Request $request)
    {
        if (!$request->hasValidSignature()) {
            abort(401);
        }

        $obitos = Corpo::with(['enderecoCorpo', 'laudoInfo']);
        $this->applyFilters($request, $obitos);

        $obitosFaixaEtaria = [
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

        foreach ($obitos->get() as $obito) {
            $dataNascimento = isset($obito->laudoInfo->data_nascimento) ? $obito->laudoInfo->data_nascimento : $obito->data_nascimento;
            $dataNascimento = Carbon::parse($dataNascimento);
            $calculoIdade = $dataNascimento->diffInYears(Carbon::parse($obito->data_obito));

            $index = match (true) {
                $calculoIdade > 85 => 0,
                $calculoIdade >= 80 => 1,
                $calculoIdade >= 75 => 2,
                $calculoIdade >= 70 => 3,
                $calculoIdade >= 65 => 4,
                $calculoIdade >= 60 => 5,
                $calculoIdade >= 55 => 6,
                $calculoIdade >= 50 => 7,
                $calculoIdade >= 45 => 8,
                $calculoIdade >= 40 => 9,
                $calculoIdade >= 35 => 10,
                $calculoIdade >= 30 => 11,
                $calculoIdade >= 25 => 12,
                $calculoIdade >= 20 => 13,
                $calculoIdade >= 15 => 14,
                $calculoIdade >= 10 => 15,
                $calculoIdade >= 5 => 16,
                default => 17,
            };

            $sexoKey = $obito->sexo == 'F' ? 'mulheres' : 'homens';
            $obitosFaixaEtaria[$index][$sexoKey]++;
        }

        $newArray = array_map(function ($item) {
            return [
                $item['faixaetaria'],
                $item['homens'] ?? 0,
                $item['mulheres'] ?? 0,
            ];
        }, $obitosFaixaEtaria);


        return response()->json($newArray);
    }

    /**
     * gerarGraficoLocalOcorrencia
     * Função para retornar os dados do gráfico de local de ocorrência no padrão do Google Charts
     *
     * @param  mixed $request
     * @return \Illuminate\Http\Response
     */
    public function gerarGraficoLocalOcorrencia(Request $request)
    {
        if (!$request->hasValidSignature()) {
            abort(401);
        }

        $query = Corpo::query();
        $this->applyFilters($request, $query);
        $obitos = $query->with('enderecoCorpo')->get();

        $dadosGrafico = [
            ['Hospital', $obitos->where('local_obito', 'Hospital')->count()],
            ['Outros estab. saúde', $obitos->where('local_obito', 'Outros estab. saúde')->count()],
            ['Domicílio', $obitos->where('local_obito', 'Domicílio')->count()],
            ['Via pública', $obitos->where('local_obito', 'Via pública')->count()],
            ['Outros', $obitos->where('local_obito', 'Outros')->count()],
            ['Aldeia Indígena', $obitos->where('local_obito', 'Aldeia Indígena')->count()],
            ['Ignorado', $obitos->where('local_obito', 'Ignorado')->count()],
        ];

        usort($dadosGrafico, function ($a, $b) {
            return $b[1] <=> $a[1];
        });

        return response()->json($dadosGrafico);
    }

    /**
     * gerar grafico por semanas gestaçao
     * Função para retornar os dados do gráfico por semanas de gestação no padrão do Google Charts
     *
     * @param  mixed $request
     * @return \Illuminate\Http\Response
     */
    public function gerarGraficoSemanasGestacao(Request $request)
    {
        if (!$request->hasValidSignature()) {
            abort(401);
        }

        $obitos = Corpo::with([
            'entrevistaInfo' => function ($query) {
                $query->where('obito_fetal', 1);
            },
            'entrevistaInfo.corpo'
        ])->whereHas('entrevistaInfo', function ($query) {
            $query->where('obito_fetal', 1);
        });

        $this->applyFilters($request, $obitos);

        $obitos = $obitos->get();

        $entrevistas_obitosfetais = new Collection();
        foreach ($obitos as $obito) {
            $entrevistas_obitosfetais->push($obito->entrevistaInfo);
        }

        $obitosfetais = new Collection();
        foreach ($entrevistas_obitosfetais as $entrevista) {
            $obitosfetais->push($entrevista->corpo);
        }

        $obitos = $obitosfetais;

        $obitosSemanasGestacao = [
            ["semanasgestacao" => "0-4", "homens" => 0, "mulheres" => 0, "total" => 0],
            ["semanasgestacao" => "5-8", "homens" => 0, "mulheres" => 0, "total" => 0],
            ["semanasgestacao" => "9-12", "homens" => 0, "mulheres" => 0, "total" => 0],
            ["semanasgestacao" => "13-16", "homens" => 0, "mulheres" => 0, "total" => 0],
            ["semanasgestacao" => "17-20", "homens" => 0, "mulheres" => 0, "total" => 0],
            ["semanasgestacao" => "21-24", "homens" => 0, "mulheres" => 0, "total" => 0],
            ["semanasgestacao" => "25-28", "homens" => 0, "mulheres" => 0, "total" => 0],
            ["semanasgestacao" => "29-32", "homens" => 0, "mulheres" => 0, "total" => 0],
            ["semanasgestacao" => "33-36", "homens" => 0, "mulheres" => 0, "total" => 0],
            ["semanasgestacao" => "37-40", "homens" => 0, "mulheres" => 0, "total" => 0],
            ["semanasgestacao" => "40+", "homens" => 0, "mulheres" => 0, "total" => 0],
        ];

        foreach ($entrevistas_obitosfetais as $obitofetal) {
            $semanas = $obitofetal->tempo_gestacao;
            $faixa = null;

            if ($semanas <= 4)
                $faixa = 0;
            elseif ($semanas <= 8)
                $faixa = 1;
            elseif ($semanas <= 12)
                $faixa = 2;
            elseif ($semanas <= 16)
                $faixa = 3;
            elseif ($semanas <= 20)
                $faixa = 4;
            elseif ($semanas <= 24)
                $faixa = 5;
            elseif ($semanas <= 28)
                $faixa = 6;
            elseif ($semanas <= 32)
                $faixa = 7;
            elseif ($semanas <= 36)
                $faixa = 8;
            elseif ($semanas <= 40)
                $faixa = 9;
            elseif ($semanas > 40)
                $faixa = 10;

            if ($faixa !== null) {
                $sexo = $obitofetal->corpo->sexo;
                $obitosSemanasGestacao[$faixa][$sexo == 'F' ? 'mulheres' : 'homens'] += 1;
                $obitosSemanasGestacao[$faixa]['total'] += 1;
            }
        }

        $arrayTratado = array_filter($obitosSemanasGestacao, function ($obito) {
            return $obito['homens'] != 0 || $obito['mulheres'] != 0;
        });

        $newArray = array_map(function ($item) {
            return [
                $item['semanasgestacao'],
                $item['homens'] ?: null,
                $item['mulheres'] ?: null,
            ];
        }, $arrayTratado);

        return response()->json($newArray);
    }


    /**
     * gerar grafico por tipo de parto
     * Função para retornar os dados do gráfico por tipo de parto no padrão do Google Charts
     *
     * @param  mixed $request
     * @return \Illuminate\Http\Response
     */
    public function a(Request $request)
    {
        if (!$request->hasValidSignature()) {
            abort(401);
        }

        $obitos = Corpo::with('enderecoCorpo');
        $this->applyFilters($request, $obitos);

        $entrevistasObitosFetais = Entrevista::where('obito_fetal', 1)
            ->whereIn('corpo_id', $obitos->pluck('id'))
            ->get();

        $obitosTipoParto = [
            'Vaginal' => ['homens' => 0, 'mulheres' => 0],
            'Cesária' => ['homens' => 0, 'mulheres' => 0],
            'Ignorado' => ['homens' => 0, 'mulheres' => 0]
        ];

        foreach ($entrevistasObitosFetais as $entrevista) {
            $tipoParto = $entrevista->tipo_de_parto;
            if (isset($obitosTipoParto[$tipoParto])) {
                $obitosTipoParto[$tipoParto][$entrevista->corpo->sexo == 'F' ? 'mulheres' : 'homens'] += 1;
            }
        }

        $resultado = array_map(function ($tipoParto, $dados) {
            return [
                $tipoParto,
                $dados['homens'] ?: null,
                $dados['mulheres'] ?: null
            ];
        }, array_keys($obitosTipoParto), $obitosTipoParto);

        return response()->json($resultado);
    }
    public function gerarGraficoTipoParto(Request $request)
    {
        if (!$request->hasValidSignature()) {
            abort(401);
        }

        $obitos = Corpo::with([
            'entrevistaInfo' => function ($query) {
                $query->where('obito_fetal', 1);
            },
            'entrevistaInfo.corpo'
        ])->whereHas('entrevistaInfo', function ($query) {
            $query->where('obito_fetal', 1);
        });
        $this->applyFilters($request, $obitos);
        $obitos = $obitos->get();

        $entrevistas_obitos_fetais = new Collection();
        foreach ($obitos as $obito) {
            $entrevistas_obitos_fetais->push($obito->entrevistaInfo);
        }

        $obitosfetais = new Collection();
        foreach ($entrevistas_obitos_fetais as $entrevista) {
            $obitosfetais->push($entrevista->corpo);
        }

        $obitos = $obitosfetais;

        $obitosTipoParto = [
            0 => ["tipoparto" => "Vaginal", "homens" => 0, "mulheres" => 0],
            1 => ["tipoparto" => "Cesárea", "homens" => 0, "mulheres" => 0],
            2 => ["tipoparto" => "Ignorado", "homens" => 0, "mulheres" => 0],
        ];

        foreach ($entrevistas_obitos_fetais as $obitofetal) {
            switch ($obitofetal->tipo_de_parto) {
                case 'Vaginal':
                    $obitosTipoParto[0][$obitofetal->corpo->sexo == 'F' ? 'mulheres' : 'homens'] += 1;
                    break;
                case 'Cesaria':
                    $obitosTipoParto[1][$obitofetal->corpo->sexo == 'F' ? 'mulheres' : 'homens'] += 1;
                    break;
                case 'Ignorado':
                    $obitosTipoParto[2][$obitofetal->corpo->sexo == 'F' ? 'mulheres' : 'homens'] += 1;
                    break;
            }
        }

        $arrayTratado = array_filter($obitosTipoParto, function ($obito) {
            return $obito['homens'] != 0 || $obito['mulheres'] != 0;
        });

        $newArray = array_map(function ($item) {
            return [
                $item['tipoparto'],
                $item['homens'] ?: null,
                $item['mulheres'] ?: null,
            ];
        }, $arrayTratado);

        return response()->json($newArray);
    }

    /**
     * gerar grafico por originados de funeraias
     * Função para retornar os dados do gráfico originados de funerarias no padrão do Google Charts
     *
     * @param  mixed $request
     * @return \Illuminate\Http\Response
     */
    public function gerarGraficoObitosPorFuneraria(Request $request)
    {
        if (!$request->hasValidSignature()) {
            abort(401);
        }

        $obitos = Corpo::with(['enderecoCorpo', 'funeraria']);
        $this->applyFilters($request, $obitos);

        $obitosFunerarias = $obitos->get()->filter(function ($obito) {
            return $obito->meio_transporte === 'Funeraria';
        });

        $totalPorFuneraria = $obitosFunerarias->groupBy('funeraria.nome')
            ->map(function ($group) {
                return $group->count();
            })
            ->toArray();

        $resultado = array_map(function ($funerariaNome, $total) {
            return [
                $funerariaNome,
                $total
            ];
        }, array_keys($totalPorFuneraria), $totalPorFuneraria);

        return response()->json($resultado);
    }

    /**
     * gerar grafico por tipo de transporte
     * Função para retornar os dados do gráfico por meio de transporte no padrão do Google Charts
     *
     * @param  mixed $request
     * @return \Illuminate\Http\Response
     */
    public function gerarGraficoTipoTransporte(Request $request)
    {
        if (!$request->hasValidSignature()) {
            abort(401);
        }

        $obitos = Corpo::with('enderecoCorpo');
        $this->applyFilters($request, $obitos);

        $obitosPorTransporte = $obitos->get()
            ->groupBy('meio_transporte')
            ->map(function ($group) {
                return [
                    'homens' => $group->where('sexo', 'M')->count(),
                    'mulheres' => $group->where('sexo', 'F')->count()
                ];
            })
            ->toArray();

        $resultado = array_map(function ($transporte, $totais) {
            return [
                $transporte,
                $totais['homens'] ?: null,
                $totais['mulheres'] ?: null
            ];
        }, array_keys($obitosPorTransporte), $obitosPorTransporte);

        return response()->json($resultado);
    }

    private function applyFilters(Request $request, $query)
    {
        $dateFilters = [
            'data_recebimento' => 'data_entrada',
            'data_nascimento' => 'data_nascimento',
            'data_obito' => 'data_obito',
        ];

        foreach ($dateFilters as $requestKey => $column) {
            if ($request->filled($requestKey)) {
                $this->applyDateFilter($request->{$requestKey}, $column, $query);
            }
        }

        $stringFilters = [
            'local_obito',
            'natimorto',
            'sexo',
            'funeraria',
            'estado',
            'cidade'
        ];

        foreach ($stringFilters as $filter) {
            if ($request->filled($filter)) {
                $query->when($filter == 'estado' || $filter == 'cidade', function ($q) use ($filter, $request) {
                    $q->whereRelation('enderecoCorpo', $filter, $request->{$filter});
                }, function ($q) use ($filter, $request) {
                    $q->where($filter, $request->{$filter});
                });
            }
        }
    }

    private function applyDateFilter($dateRange, $column, $query)
    {
        $dates = explode('-', str_replace(' ', '', $dateRange));
        $startDate = Carbon::createFromFormat('d/m/Y', $dates[0]);
        $endDate = Carbon::createFromFormat('d/m/Y', $dates[1]);

        $query->whereBetween($column, [$startDate, $endDate]);
    }
}
