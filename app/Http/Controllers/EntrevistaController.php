<?php

namespace App\Http\Controllers;

use App\Models\ExameStatus;
use Illuminate\Http\Request;
use App\Models\Entrevista;
use App\Models\Corpo;
use App\Models\Endereco;
use App\Models\HistoricoCorpo;
use App\Models\Ocupacao;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class EntrevistaController extends Controller
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        DB::enableQueryLog();
        $this->middleware('permission:entrevistas_view', ['only' => ['index', 'show']]);
        $this->middleware('permission:entrevistas_create', ['only' => ['create', 'store', 'selecionarCorpo']]);
        $this->middleware('permission:entrevistas_edit', ['only' => ['edit', 'update']]);
    }

    /**
     * index
     * Função para listar e filtras as entrevistas
     *
     * @param  mixed $request
     * @return void
     */
    public function index(Request $request)
    {
        $entrevistas = Entrevista::select('entrevistas.*')
            ->with('corpo.responsavelCorpo')
            ->leftJoin('corpos', 'entrevistas.corpo_id', '=', 'corpos.id')
            ->leftJoin('responsaveis', 'corpos.responsavel_corpo_id', '=', 'responsaveis.id');

        // Filtrar por nome do responsável
        if ($request->nomeResponsavel) {
            $entrevistas = $entrevistas->whereHas('corpo.responsavelCorpo', function ($q) use ($request) {
                $q->where('nome', 'like', '%' . strtoupper($request->nomeResponsavel) . '%');
            });
        }

        // Filtrar por nome do corpo
        if ($request->nomeCorpo) {
            $entrevistas = $entrevistas->whereHas('corpo', function ($q) use ($request) {
                $q->where('nome', 'like', '%' . strtoupper($request->nomeCorpo) . '%');
            });
        }
        
        if ($request->dataInicial) {
            $dataFinal = $request->dataFinal ? $request->dataFinal : Carbon::now();
            $entrevistas = $entrevistas->whereBetween('entrevistas.created_at', [$request->dataInicial, $dataFinal]);
        }

        if ($request->filtroStatus) {
            $entrevistas = $entrevistas->where('entrevistas.status_id', $request->filtroStatus);
        }

        if ($request->filtroCorpo) {
            $entrevistas = $entrevistas->where('entrevistas.corpo_id', $request->filtroCorpo);
        }

        if ($request->filtroResponsavel) {
            $entrevistas = $entrevistas->whereRelation('corpo', 'responsavel_corpo_id', '=', $request->filtroResponsavel);
        }

        $sort = $request->get('sort', 'entrevistas.created_at');
        $direction = $request->get('direction', 'desc');

        $sortMapping = [
            'id' => 'entrevistas.id',
            'responsavel_nome' => 'responsaveis.nome',
            'corpo_nome' => 'corpos.nome',
            'created_at' => 'entrevistas.created_at',
        ];

        if (array_key_exists($sort, $sortMapping)) {
            $sortColumn = $sortMapping[$sort];
        } else {
            $sortColumn = 'entrevistas.created_at';
        }

        $entrevistas = $entrevistas->orderBy($sortColumn, $direction);

        //$entrevistas = $entrevistas->get();
        $corpos = Corpo::whereNotNull('entrevista_id')->get();
        $exameStatus = ExameStatus::all();
        $entrevistas = $entrevistas->paginate(10);
        return view('entrevistas.index', compact('entrevistas', 'corpos', 'exameStatus'));
    }
    /**
     * show
     * Função que mostra os detalhes de uma entrevista especifica
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        $entrevista = Entrevista::find($id);

        return view('entrevistas.show', compact('entrevista'));
    }
    /**
     * selecionarCorpo
     * Função que mostra o formulário de selecionar o corpo para realizar uma entrevista
     *
     * @return void
     */
    public function selecionarCorpo()
    {
        $corpos = Corpo::where('entrevista_id', null)->get();
        return view('entrevistas.selecionar-corpo', compact('corpos'));
    }
    /**
     * create
     * Função que mostra o formulário de criação da entrevista e altera o status para "Em Entrevista"
     *
     * @param  mixed $id
     * @return void
     */
    public function create($id)
    {
        $verificarEntrevista = Entrevista::where('corpo_id', $id)->count();
        if ($verificarEntrevista > 0) {
            return redirect()->route('entrevistas.index')->with('error', 'Já existe uma entrevista cadastrada para esse corpo');
        }
        $corpo = Corpo::find($id);
        $ocupacoes = DB::table('tb_ocupacao_sinonimos')->get();
        $ocupacoes = $ocupacoes->concat(DB::table('tb_ocupacao')->get());
        $corpo->status = 3;
        $corpo->status_anterior = 3;
        $corpo->save();

        $usuarios = User::role('Serviço Social')->get();
        return view('entrevistas.create', compact('corpo', 'ocupacoes', 'usuarios'));
    }
    /**
     * store
     * Função para armazenar os dados da entrevista e cria-la
     * 
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        try {

            $info = $request->all();
            $info['status_id'] = 1;
            if (isset($info['aposentado'])) {
                $info['aposentado'] = $info['aposentado'] == 'on' ? 1 : 0;
            }
            if (isset($info['aposentado_mae'])) {
                $info['aposentado_mae'] = $info['aposentado_mae'] == 'on' ? 1 : 0;
            }
            //verificar se o campo outro_cbo existe
            if (isset($info['outro_cbo_mae'])) {
                $info['outro_cbo_mae'] = $info['outro_cbo_mae'] == 'on' ? 1 : 0;
            }
            if (isset($info['outro_cbo_corpo'])) {
                $info['outro_cbo_corpo'] = $info['outro_cbo_corpo'] == 'on' ? 1 : 0;
            }
            //verifica se o novo cbo veio preenchido
            if (isset($info['outro_cbo_mae']) == 1) {
                //verifica se o novo cbo já existe no banco
                $verificarCbo = DB::table('tb_ocupacao_sinonimos')->where('ds_ocupacao', $info['novo_cbo_mae'])->count();
                if ($verificarCbo > 0) {
                    $novo_cbo_mae = DB::table('tb_ocupacao_sinonimos')->where('ds_ocupacao', $info['novo_cbo_mae'])->first();
                } else {
                    //cadastra o novo cbo no banco
                    $novo_cbo_mae = DB::table('tb_ocupacao_sinonimos')->insertGetId([
                        'co_cbo' => null,
                        'ds_ocupacao' => $info['novo_cbo_mae'],
                        'TIPO' => 'outros',
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                }
            }

            if (isset($info['outro_cbo_corpo']) == 1) {

                //verifica se o novo cbo já existe no banco
                $verificarCbo = DB::table('tb_ocupacao_sinonimos')->where('ds_ocupacao', $info['novo_cbo_corpo'])->count();
                if ($verificarCbo > 0) {
                    $novo_cbo_corpo = DB::table('tb_ocupacao_sinonimos')->where('ds_ocupacao', $info['novo_cbo_corpo'])->first();
                } else {

                    //cadastra o novo cbo no banco
                    $novo_cbo_corpo = DB::table('tb_ocupacao_sinonimos')->insertGetId([
                        'co_cbo' => null,
                        'ds_ocupacao' => $info['novo_cbo_corpo'],
                        'TIPO' => 'outros',
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                }
            }

            if (isset($info['outro_cbo_mae']) == 1) {
                if (is_int($novo_cbo_mae)) {
                    $info['ocupacao_mae_id'] = strval($novo_cbo_mae);
                } elseif (is_object($novo_cbo_mae)) {
                    $info['ocupacao_mae_id'] = $novo_cbo_mae->id;
                }
            }
            if (isset($info['outro_cbo_corpo']) == 1) {
                $info['ocupacao_id'] = $novo_cbo_corpo->id;
            }
            $verificarEntrevista = Entrevista::where('corpo_id', $request->corpo_id)->count();
            if ($verificarEntrevista > 0) {
                return redirect()->route('entrevistas.index')->with('error', 'Já existe uma entrevista cadastrada para esse corpo');
            }
            if ($request->obito_fetal == 1) {
                $enderecoMae = Endereco::create([
                    'logradouro' => $info['logradouro_mae'],
                    'numero' => $info['numero_mae'],
                    'complemento' => $info['complemento_mae'],
                    'bairro' => $info['bairro_mae'],
                    'cidade' => $info['cidade_mae'],
                    'estado' => $info['estado_mae'],
                    'cep' => $info['cep_mae'],
                ]);
                $info['endereco_mae_id'] = $enderecoMae->id;
            }
            if (isset($request->escrivao_id) != null) {
                $info['entrevistado_por'] =  $request->escrivao_id ?? Auth::user()->id;
                $info['digitador_id'] = Auth::user()->id;
            }
            
            //atualiza o campo cod_cbo
            //dd($info['ocupacao_id']);

            if (isset($info['ocupacao_id']) && $info['ocupacao_id'] !== null) {
                $info['cod_cbo'] = $this->getOcupacaoById($info['ocupacao_id']);
            } elseif (isset($info['ocupacao_mae_id']) && $info['ocupacao_mae_id'] !== null) {
                $info['cod_cbo'] = $this->getOcupacaoById($info['ocupacao_mae_id']);
            }

            $entrevista = Entrevista::create($info);
            $corpo = Corpo::find($request->corpo_id);
            $corpo->entrevista_id = $entrevista->id;
            if ($corpo->status != 8) {
                $corpo->status = 5;
                $corpo->status_anterior = 5;
            }

            $corpo->save();
            $dados = [
                'titulo' => 'Entrevista com Serviço Social',
                'conteudo' => 'Entrevista realizada com o serviço social referente ao falecido(a)  ' . $corpo->nome . ' realizada por(a) ' . auth()->user()->name . ' às ' . Carbon::now()->format('H:i'),
                'icon' => 'bi-clipboard2',
                'corpo_id' => $corpo->id
            ];
            $historico = HistoricoCorpo::create($dados);
            return redirect()->route('entrevistas.index')->with('success', 'Entrevista realizada com sucesso!');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->route('entrevistas.index')->with('error', 'Erro ao realizar a entrevista!');
        }
    }

    /**
     * edit
     * Função para mostrar o formulário de edição de uma entrevista
     *
     * @param  mixed $id
     * @return void
     */
    public function edit($id)
    {
        $entrevista = Entrevista::find($id);
        $ocupacoes = DB::table('tb_ocupacao_sinonimos')->get();
        $ocupacoes = $ocupacoes->concat(DB::table('tb_ocupacao')->get());
        //se tem cod cbo busca na tabela de ocupação
        if ($entrevista->cod_cbo) {
            $ocup = $this->getOcupacaoByCbo($entrevista->cod_cbo);
            //coloca o - depois do 4 digitos
            $ocup = substr($ocup, 0, 4) . '-' . substr($ocup, 4);
        } else {
            $ocup = $this->getOcupacaoById($entrevista->ocupacao_id ?? $entrevista->ocupacao_mae_id);
        }
        //dd($ocupacoes);
        $endereco_mae = Endereco::find($entrevista->endereco_mae_id);
        $usuarios = User::role('Serviço Social')->get();
        $status = Corpo::find($entrevista->corpo_id)->status;

        return view('entrevistas.edit', compact('entrevista', 'ocupacoes', 'endereco_mae', 'usuarios', 'status', 'ocup'));
    }
    /**
     * update
     * Função para atualizar os dados de uma entrevista
     *
     * @param  mixed $request
     * @return void
     */
    public function update(Request $request)
    {
        $info = $request->all();

        $corpoDados = Corpo::find($info['corpo_id']);
        if (empty($request->justificativa) && $corpoDados->status == 6) {
            throw ValidationException::withMessages(['justificativa' => 'A justificativa é obrigatória.']);
        }
        try {
            if (isset($info['aposentado'])) {
                $info['aposentado'] = $info['aposentado'] == 'on' ? 1 : 0;
            } else {
                $info['aposentado'] = 0;
            }
            if (!isset($info['escolaridade_corpo_serie'])) {
                $info['escolaridade_corpo_serie'] = "Ignorado";
            }
            if ($request->obito_fetal == 1) {
                if (isset($info['aposentado_mae'])) {
                    $info['aposentado_mae'] = $info['aposentado_mae'] == 'on' ? 1 : 0;
                } else {
                    $info['aposentado_mae'] = 0;
                }
                //verificar se o campo outro_cbo existe
                if (isset($info['outro_cbo_mae'])) {
                    $info['outro_cbo_mae'] = $info['outro_cbo_mae'] == 'on' ? 1 : 0;
                }
            }

            //verifica se o novo cbo veio preenchido
            if (isset($info['outro_cbo_mae']) == 1) {
                //verifica se o novo cbo já existe no banco
                $verificarCbo = DB::table('tb_ocupacao_sinonimos')->where('ds_ocupacao', $info['novo_cbo_mae'])->count();
                if ($verificarCbo > 0) {
                    $novo_cbo_mae = DB::table('tb_ocupacao_sinonimos')->where('ds_ocupacao', $info['novo_cbo_mae'])->first();
                } else {
                    //cadastra o novo cbo no banco
                    $novo_cbo_mae = DB::table('tb_ocupacao_sinonimos')->insertGetId([
                        'co_cbo' => null,
                        'ds_ocupacao' => $info['novo_cbo_mae'],
                        'TIPO' => 'outros',
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                }
            }
            if (isset($info['outro_cbo_corpo'])) {
                $info['outro_cbo_corpo'] = $info['outro_cbo_corpo'] == 'on' ? 1 : 0;
            }

            if (isset($info['outro_cbo_corpo']) == 1) {
                //verifica se o novo cbo já existe no banco
                $verificarCbo = DB::table('tb_ocupacao_sinonimos')->where('ds_ocupacao', $info['novo_cbo_corpo'])->count();
                if ($verificarCbo > 0) {
                    $novo_cbo_corpo = DB::table('tb_ocupacao_sinonimos')->where('ds_ocupacao', $info['novo_cbo_corpo'])->first();
                } else {
                    //cadastra o novo cbo no banco
                    $novo_cbo_corpo = DB::table('tb_ocupacao_sinonimos')->insertGetId([
                        'co_cbo' => null,
                        'ds_ocupacao' => $info['novo_cbo_corpo'],
                        'TIPO' => 'outros',
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                }
            }

            if (isset($info['outro_cbo_mae']) == 1) {
                if (is_int($novo_cbo_mae)) {
                    $info['ocupacao_mae_id'] = strval($novo_cbo_mae);
                } elseif (is_object($novo_cbo_mae)) {
                    $info['ocupacao_mae_id'] = $novo_cbo_mae->id;
                }
            }
            if (isset($info['outro_cbo_corpo']) == 1) {
                if (is_int($novo_cbo_corpo)) {
                    $info['ocupacao_id'] = strval($novo_cbo_corpo);
                } elseif (is_object($novo_cbo_corpo)) {
                    $info['ocupacao_id'] = $novo_cbo_corpo->id;
                }
            }
            if (isset($request->escrivao_id) != null) {
                $info['entrevistado_por'] =  $request->escrivao_id ?? Auth::user()->id;
            }
            $ocupacoes = DB::table('tb_ocupacao_sinonimos')->get();
            $ocupacoes = $ocupacoes->concat(DB::table('tb_ocupacao')->get());
            //atualiza o campo cod_cbo
            if (isset($info['ocupacao_id'])) {
                $info['cod_cbo'] = $this->getOcupacaoById($info['ocupacao_id']);
            } else if (isset($info['ocupacao_mae_id'])) {
                $info['cod_cbo'] = $this->getOcupacaoById($info['ocupacao_mae_id']);
            }
            $entrevista = Entrevista::find($request->entrevista_id)->update($info);

            // Salvar justificativa na tabela corpos se status = 6
            if ($corpoDados->status == 6 && !empty($request->justificativa)) {
                $corpoDados->justificativa = $request->justificativa;
                $corpoDados->save();
            }

            if ($entrevista) {
                return redirect()->route('entrevistas.index')->with('success', 'Entrevista atualizada com sucesso!');
            }
        } catch (\Exception $e) {
            //retorna para a página de edit com uma mensagem de erro e o mesmo formulário preencido
            Log::error($e->getMessage());
            return redirect()->route('entrevistas.edit', $request->entrevista_id)->with('error', ' Erro ao atualizar a entrevista!');
        }
    }

    public function getOcupacaoById($ocupacao_id)
    {
        if (!$ocupacao_id) {
            return null;
        }

        $coCbo = str_replace('-', '', $ocupacao_id);

        // Tenta encontrar primeiro na tabela principal
        $ocupacao = DB::table('tb_ocupacao')
            ->where('co_cbo', $coCbo)
            ->first();

        if ($ocupacao) {
            return $ocupacao->co_cbo;
        }

        // Se não achar, tenta na tabela de sinônimos
        $ocupacaoSinonimo = DB::table('tb_ocupacao_sinonimos')
            ->where('co_cbo', $coCbo)
            ->first();

        return $ocupacaoSinonimo->co_cbo ?? null;
    }


    public function getOcupacaoByCbo($cbo)
    {
        $ocupacao = DB::table('tb_ocupacao')->where('co_cbo', str_replace('-', '', $cbo))->first()->co_cbo;
        return $ocupacao ?? null;
    }
}
