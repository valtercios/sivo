<?php

namespace App\Http\Controllers;

use App\Helpers\UtilsHelpers;
use App\Models\Corpo;
use App\Models\CorpoStatus;
use App\Models\Endereco;
use App\Models\Entrevista;
use App\Models\Exame;
use App\Models\Funeraria;
use App\Models\HistoricoCorpo;
use App\Models\Justificativa;
use App\Models\Laudo;
use App\Models\MedicoExterno;
use App\Models\OrgaoEmissor;
use App\Models\Responsavel;
use App\Models\Unidade;
use App\Models\User;
use App\Notifications\SystemNotification;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\ValidationException;


class CorpoController extends Controller
{
    /**
     * Construct possui a chamada de log e as restrinções de permissões do usuario.
     *
     * @return void
     */
    public function __construct()
    {
        DB::enableQueryLog();
        $this->middleware('permission:corpos_view', ['only' => ['index', 'show']]);
        $this->middleware('permission:corpos_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:corpos_delete', ['only' => ['destroy']]);
        $this->middleware('permission:corpos_edit', ['only' => ['edit', 'update']]);
    }

    /**
     * Index possui a listagem de corpos.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $status = CorpoStatus::all();
        $corpos = Corpo::with('corpoStatus');

        if ($request->nome) {
            $corpos = $corpos->where('nome', 'like', '%' . strtoupper($request->nome) . '%');
        }

        if ($request->dataInicial) {
            $dataFinal = $request->dataFinal ? $request->dataFinal : Carbon::now();
            $corpos = $corpos->whereBetween('data_entrada', [$request->dataInicial, $dataFinal]);
        }

        if ($request->filtroStatus) {
            $corpos = $corpos->where('status', $request->filtroStatus);
        }

        // Ordena pendentes (status 4) primeiro
        // $corpos = $corpos->orderByRaw("status = 4 DESC");

        // Depois ordena pelo mais recente
        // $corpos = $corpos->orderBy('created_at', 'DESC');

        // ORDENAR
        $sort = $request->get('sort', 'created_at');
        $direction = $request->get('direction', 'desc');

        // segurança: só ordena colunas permitidas
        $allowedSorts = ['id', 'num_vo', 'nome', 'sexo', 'created_at'];
        if (!in_array($sort, $allowedSorts)) {
            $sort = 'id';
        }

        $corpos->orderBy($sort, $direction);
        // Aqui pagina registros
        $corpos = $corpos->paginate(10);

        return view('corpos.index', compact('corpos', 'status'));
    }

    /**
     * Create possui a view de cadastro de corpos.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $funerarias = Funeraria::all();
        $orgaos_emissores = OrgaoEmissor::all();
        $usuarios = User::role('Recepção')->get();
        return view('corpos.create', compact('funerarias', 'orgaos_emissores', 'usuarios'));
    }

    /**
     * atribuirvo
     * Função para atribuir o número de VO a um corpo
     *
     * @param  mixed $request
     * @return void
     */
    public function atribuirvo(Request $request)
    {
        $corpo_id = $request->corpo_id;
        $corpo = Corpo::find($corpo_id);
        $verificarExistenciaVO = Corpo::where('num_vo', $request->num_vo)->where('ano_vo', $request->ano_vo)->first();
        if ($verificarExistenciaVO) {
            return redirect()->route('corpos.show', $corpo_id)->with('danger', 'Já existe um corpo atribuído á esse número de VO!');
        }
        $corpo->num_vo = $request->num_vo;
        $corpo->ano_vo = $request->ano_vo;
        $corpo->update();
        $dados = [
            'titulo' => 'Número de VO atribuído',
            'conteudo' => 'O número de VO foi atribúido ao corpo de ' . strtoupper($corpo->nome) . ' por(a) ' . auth()->user()->name . ' às ' . Carbon::now()->format('H:i'),
            'icon' => 'bi-tag',
            'corpo_id' => $corpo->id
        ];
        $historico = HistoricoCorpo::create($dados);
        return redirect()->route('corpos.show', $corpo_id)->with('success', 'Número de VO atribuída com sucesso!');
    }

    /**
     * encaminharitep
     * Função para encaminhar um corpo para a itep
     *
     * @param  mixed $request
     * @return void
     */
    public function encaminharitep(Request $request)
    {
        $corpo_id = $request->corpo_id;
        $corpo = Corpo::find($corpo_id);
        if ($corpo->encaminhar_itep == '1') {
            return redirect()->route('corpos.show', $corpo_id)->with('danger', 'Esse corpo já foi encaminhado para a ITEP.');
        }
        $corpo->encaminhar_itep = '1';
        $corpo->status = 7;
        $corpo->status_anterior = 7;
        $corpo->update();
        $dados = [
            'titulo' => 'Encaminhado para a ITEP',
            'conteudo' => 'O corpo de ' . strtoupper($corpo->nome) . ' foi encaminhado para a itep por(a) ' . auth()->user()->name . ' às ' . Carbon::now()->format('H:i'),
            'icon' => 'bi-box-arrow-left',
            'corpo_id' => $corpo->id
        ];
        $historico = HistoricoCorpo::create($dados);
        return redirect()->route('corpos.show', $corpo_id)->with('success', 'Corpo encaminhado para a itep com sucesso!');
    }

    /**
     * encaminharliga
     * Função para encaminhar um corpo para a LIGA
     *
     * @param  mixed $request
     * @return void
     */
    public function encaminharliga(Request $request)
    {
        $corpo_id = $request->corpo_id;
        $corpo = Corpo::find($corpo_id);
        if ($corpo->encaminhar_liga == '1') {
            return redirect()->route('corpos.show', $corpo_id)->with('danger', 'Esse corpo já foi encaminhado para a LIGA.');
        }
        $corpo->encaminhar_liga = '1';
        $corpo->status = 9;
        $corpo->status_anterior = 9;
        $corpo->update();
        $dados = [
            'titulo' => 'Encaminhado para a LIGA',
            'conteudo' => 'O corpo de ' . strtoupper($corpo->nome) . ' foi encaminhado para a LIGA por(a) ' . auth()->user()->name . ' às ' . Carbon::now()->format('H:i'),
            'icon' => 'bi-box-arrow-left',
            'corpo_id' => $corpo->id
        ];
        $historico = HistoricoCorpo::create($dados);
        return redirect()->route('corpos.show', $corpo_id)->with('success', 'Corpo encaminhado para a liga com sucesso!');
    }

    /**
     * devolverCorpo
     * Função para devolver um corpo para um hospital
     *
     * @param  mixed $request
     * @return void
     */

    public function devolverCorpo(Request $request)
    {
        $corpo_id = $request->corpo_id;
        $corpo = Corpo::find($corpo_id);
        if ($corpo->devolver_corpo == '1') {
            return redirect()->route('corpos.show', $corpo_id)->with('danger', 'Esse corpo já foi devolvido.');
        }
        $corpo->devolver_corpo = '1';
        $corpo->status = 10;
        $corpo->status_anterior = 10;
        $corpo->justificativa = $request->input('justificativa');
        $corpo->estabelecimento_destino = $request->input('estabelecimento_destino');
        $corpo->update();
        $dados = [
            'titulo' => 'Corpo devolvido',
            'conteudo' => 'O corpo de ' . strtoupper($corpo->nome) . ' foi devolvido por(a) ' . auth()->user()->name . ' às ' . Carbon::now()->format('H:i'),
            'icon' => 'bi-box-arrow-left',
            'corpo_id' => $corpo->id
        ];
        $historico = HistoricoCorpo::create($dados);
        return redirect()->route('corpos.show', $corpo_id)->with('success', 'Corpo devolvido com sucesso!');
    }

    /**
     * Store possui a função de salvar os dados no banco de dados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $dados = request()->all();

        if (isset($dados['natimorto'])) {
            $dados['natimorto'] = $dados['natimorto'] == "1" ? 1 : 0;
            if ($dados['natimorto'] == 1) {
                unset($dados['data_nascimento']);
            }
        } else {
            $dados['natimorto'] = 0;
        }

        try {
            //Definir a data de entrada do corpo
            $dados['data_entrada'] = Carbon::now();

            $verificarCorpo = Corpo::where('cpf', $request->cpf_corpo)->count();
            if ($verificarCorpo > 0 && $request->cpf_corpo != null) {
                throw new \Exception("Um corpo com esse CPF já está cadastrado");
            }

            //verifica se o cpf  do corpo é valido
            if ($request->has('cpf_corpo')) {
                if (!UtilsHelpers::validaCPF($request->cpf_corpo)) {
                    return back()->with('error', 'CPF do corpo inválido')->withInput($request->all());
                }
            }

            //verifica se o cpf do responsavel da entrega do corpo é valido
            if ($request->has('cpf_responsavel_entrega')) {
                if (!UtilsHelpers::validaCPF($request->cpf_responsavel_entrega)) {
                    return back()->with('error', 'CPF do responsavel da entrega inválido')->withInput($request->all());
                }
            }
            //verifica se o cpf do responsavel do corpo é valido
            if ($request->has('cpf_responsavel')) {
                if (!UtilsHelpers::validaCPF($request->cpf_responsavel)) {
                    return back()->with('error', 'CPF do responsavel do corpo inválido')->withInput($request->all());
                }
            }

            //verifica se a data do obito é maior que um ano atrás
            $obito_corpo = new DateTime($dados['data_obito']);
            $time = "365";
            $data_atual = (new DateTime())->modify('-' . $time . ' day');
            if ($obito_corpo < $data_atual) {
                return back()->with('error', 'Data de óbito menor que um ano atras')->withInput($request->all());
            }
            //verifica se a data do obito é maior que a data atual
            $obito_corpo = new DateTime($request->data_obito);
            $data_atual = new DateTime();
            if ($obito_corpo > $data_atual) {
                return back()->with('error', 'Data de óbito invalida')->withInput($request->all());
            }

            //verifica se a data de nascimento é menor que o ano 1850
            if ($dados['natimorto'] == 0) {
                $nascimento_corpo = new DateTime(Carbon::createFromFormat('d/m/Y', $dados['data_nascimento'])->format('Y-m-d'));
                $max_nascimento = new DateTime('1850-01-01');
                if ($nascimento_corpo < $max_nascimento) {
                    return back()->with('error', 'Data de nascimento invalida')->withInput($request->all());
                }
                //verificar se a data de obito é maior que a de nascimento
                if ($obito_corpo < $nascimento_corpo) {
                    return back()->with('error', 'Data de óbito menor que a data de nascimento')->withInput($request->all());
                }
            }

            //verifica o tipo de documento
            if ($request->tipo_documento != "RG") {
                if ($request->tipo_documento != "Nao Possui" && $request->numero_documento == null) {
                    return back()->with('error', 'É necessário informar o número do documento do CORPO')->withInput($request->all());
                }
                if ($request->tipo_documento == "Nao Possui" && isset($request->numero_documento)) {
                    $dados['numero_documento'] = null;
                    $dados['rg_corpo'] = null;
                    $dados['orgao_emissor_corpo'] = null;
                    $dados['estado_rg'] = null;
                } else {
                    $dados['rg_corpo'] = null;
                    $dados['orgao_emissor_corpo'] = null;
                    $dados['estado_rg'] = null;
                }
            }
            if ($request->tipo_documento == 'RG') {
                if (empty($request->rg_corpo)) {
                    return back()->with('error', 'É necessário informar o RG do CORPO')->withInput($request->all());
                }
                if (empty($request->orgao_emissor_corpo)) {
                    return back()->with('error', 'É necessário informar o Órgão Emissor do RG do CORPO')->withInput($request->all());
                }
                if (empty($request->estado_rg)) {
                    return back()->with('error', 'É necessário informar a UF do RG do CORPO')->withInput($request->all());
                }
                $dados['orgao_emissor_corpo'] = $request->orgao_emissor_corpo;
                $dados['estado_rg'] = $request->estado_rg;
            }

            //verifica se cadastrou o responsavel pela entrega se rg, caso contrario volta para a tela de cadastro
            if ($request->tipo_documento_responsavel_entrega != "RG") {
                if ($request->tipo_documento_responsavel_entrega != "Nao Possui" && empty($request->numero_documento_responsavel_entrega)) {
                    return back()->with('error', 'É necessário informar o número do documento do RESPONSAVEL PELA ENTREGA')->withInput($request->all());
                }
                if ($request->tipo_documento_responsavel_entrega == "Nao Possui" && isset($request->numero_documento_responsavel_entrega)) {
                    $dados['numero_documento_responsavel_entrega'] = null;
                    $dados['rg_responsavel_entrega'] = null;
                    $dados['orgao_emissor_responsavel_entrega'] = null;
                    $dados['estado_rg_responsavel_entrega'] = null;
                } else {
                    $dados['rg_responsavel_entrega'] = null;
                    $dados['orgao_emissor_responsavel_entrega'] = null;
                    $dados['estado_rg_responsavel_entrega'] = null;
                }
            }
            if ($request->tipo_documento_responsavel_entrega == 'RG') {
                if (empty($request->rg_responsavel_entrega)) {
                    return back()->with('error', 'É necessário informar o RG do RESPONSAVEL PELA ENTREGA')->withInput($request->all());
                }
                if (empty($request->orgao_emissor_responsavel_entrega)) {
                    return back()->with('error', 'É necessário informar o Órgão Emissor do RG do RESPONSAVEL PELA ENTREGA')->withInput($request->all());
                }
                if (empty($request->estado_rg_responsavel_entrega)) {
                    return back()->with('error', 'É necessário informar a UF do RG do RESPONSAVEL PELA ENTREGA')->withInput($request->all());
                }
                $dados['orgao_emissor_responsavel_entrega'] = $request->orgao_emissor_responsavel_entrega;
                $dados['estado_rg_responsavel_entrega'] = $request->estado_rg_responsavel_entrega;
            }


            //verifica se cadastrou o responsavel pela entrega se rg, caso contrario volta para a tela de cadastro
            if ($dados['responsavel_entrega_igual'] == 0) {
                if ($request->tipo_documento_responsavel != "RG") {
                    if ($request->tipo_documento_responsavel != "Nao Possui" && empty($request->numero_documento_responsavel)) {
                        return back()->with('error', 'É necessário informar o número do documento do RESPONSAVEL')->withInput($request->all());
                    }
                    if ($request->tipo_documento_responsavel == "Nao Possui" && isset($request->numero_documento_responsavel)) {
                        $dados['numero_documento_responsavel'] = null;
                        $dados['rg_responsavel'] = null;
                        $dados['orgao_emissor_responsavel'] = null;
                        $dados['estado_rg_responsavel_corpo'] = null;
                    } else {
                        $dados['rg_responsavel'] = null;
                        $dados['orgao_emissor_responsavel'] = null;
                        $dados['estado_rg_responsavel_corpo'] = null;
                    }
                }
                if ($request->tipo_documento_responsavel == 'RG') {
                    if (empty($request->rg_responsavel)) {
                        return back()->with('error', 'É necessário informar o RG do RESPONSAVEL')->withInput($request->all());
                    }
                    if (empty($request->orgao_emissor_responsavel)) {
                        return back()->with('error', 'É necessário informar o Órgão Emissor do RG do RESPONSAVEL')->withInput($request->all());
                    }
                    if (empty($request->estado_rg_responsavel_corpo)) {
                        return back()->with('error', 'É necessário informar a UF do RG do RESPONSAVEL')->withInput($request->all());
                    }
                    $dados['orgao_emissor_responsavel'] = $request->orgao_emissor_responsavel;
                    $dados['estado_rg_responsavel'] = $request->estado_rg_responsavel_corpo;
                }
            }


            $nome_estabelecimento = null;
            $cnes_estabelecimento = null;
            $situacao = null;

            if ($request->local_obito == "Hospital" || $request->local_obito == "Outros estab. saúde") {
                $nome_estabelecimento = $request->estabelecimento_obito;
                $cnes_estabelecimento = $request->cnes_estabelecimento;
            }

            if ($request->local_obito == "Outros" || $request->local_obito == "Via pública") {
                $situacao = $request->situacao;
            }
            //Cadastrar os endereços

            //verifica se é estrangeiro
            if (isset($dados['estrangeiro_check']) == 1) {
                $enderecoCorpo = Endereco::create([
                    'pais' => $dados['nacionalidade'],
                    'endereco_postal' => $dados['endereco_postal_corpo'],
                ]);
            } else {
                $enderecoCorpo = Endereco::create([
                    'logradouro' => $dados['logradouro_corpo'],
                    'numero' => $dados['numero_corpo'],
                    'complemento' => $dados['complemento_corpo'],
                    'bairro' => $dados['bairro_corpo'],
                    'cidade' => $dados['cidade_corpo'],
                    'estado' => $dados['estado_corpo'],
                    'cep' => $dados['cep_corpo'],
                ]);
            }
            $enderecoObito = Endereco::create([
                'logradouro' => $dados['logradouro_obito'],
                'numero' => $dados['numero_obito'],
                'complemento' => $dados['complemento_obito'],
                'bairro' => $dados['bairro_obito'],
                'cidade' => $dados['cidade_obito'],
                'estado' => $dados['estado_obito'],
                'cep' => $dados['cep_obito'],
            ]);
            $enderecoResponsavelEntrega = Endereco::create([
                'logradouro' => $dados['logradouro_responsavel_entrega'],
                'numero' => $dados['numero_responsavel_entrega'],
                'complemento' => $dados['complemento_responsavel_entrega'],
                'bairro' => $dados['bairro_responsavel_entrega'],
                'cidade' => $dados['cidade_responsavel_entrega'],
                'estado' => $dados['estado_responsavel_entrega'],
                'cep' => $dados['cep_responsavel_entrega'],
            ]);

            if ($dados['responsavel_entrega_igual'] == 0) {
                $enderecoResponsavel = Endereco::create([
                    'logradouro' => $dados['logradouro_responsavel'],
                    'numero' => $dados['numero_responsavel'],
                    'complemento' => $dados['complemento_responsavel'],
                    'bairro' => $dados['bairro_responsavel'],
                    'cidade' => $dados['cidade_responsavel'],
                    'estado' => $dados['estado_responsavel'],
                    'cep' => $dados['cep_responsavel'],
                ]);
            }

            if ($dados['responsavel_entrega_igual'] == 1) {
                $enderecoResponsavel = Endereco::create([
                    'logradouro' => $dados['logradouro_responsavel_entrega'],
                    'numero' => $dados['numero_responsavel_entrega'],
                    'complemento' => $dados['complemento_responsavel_entrega'],
                    'bairro' => $dados['bairro_responsavel_entrega'],
                    'cidade' => $dados['cidade_responsavel_entrega'],
                    'estado' => $dados['estado_responsavel_entrega'],
                    'cep' => $dados['cep_responsavel_entrega'],
                ]);
            }
            //Cadastrar os responsáveis
            if (isset($enderecoResponsavel)) {
                //caso responsavel pela entrega seja igual ao responsavel do corpo e parentesco for outros
                if ($dados['responsavel_entrega_igual'] == 1 && $dados['grau_parentesco_responsavel'] == 'Outros') {
                    $responsavelCorpo = Responsavel::create([
                        'nome' => $dados['nome_responsavel_entrega'],
                        'rg' => $dados['rg_responsavel_entrega'] ?? null,
                        'orgao_emissor' => $dados['orgao_emissor_responsavel_entrega'] ?? null,
                        'estado_rg' => $dados['estado_rg_responsavel_entrega']  ?? null,
                        'cpf' => $dados['cpf_responsavel_entrega'] ?? null,
                        'parente' => 1,
                        'telefone' => $dados['telefone_responsavel_entrega'],
                        'grau_parentesco' => $dados['grau_parentesco_responsavel_outros'],
                        'outro_parentesco' => $dados['grau_parentesco_responsavel_outros'],
                        'tipo_documento' => $dados['tipo_documento_responsavel_entrega'] ?? null,
                        'numero_documento' => $dados['numero_documento_responsavel_entrega'] ?? null,
                        'endereco_id' => $enderecoResponsavel->id,
                        //                        'nacionalidade' => $dados['nacionalidade_responsavel_2'] ?? null,
                    ]);
                }
                //caso responsavel pela entrega seja igual ao responsavel do corpo
                else if ($dados['responsavel_entrega_igual'] == 1) {
                    $responsavelCorpo = Responsavel::create([
                        'nome' => $dados['nome_responsavel_entrega'],
                        'rg' => $dados['rg_responsavel_entrega'] ?? null,
                        'orgao_emissor' => $dados['orgao_emissor_responsavel_entrega'] ?? null,
                        'estado_rg' => $dados['estado_rg_responsavel_entrega']  ?? null,
                        'cpf' => $dados['cpf_responsavel_entrega'] ?? null,
                        'parente' => 1,
                        'telefone' => $dados['telefone_responsavel_entrega'],
                        'grau_parentesco' => $dados['grau_parentesco_responsavel'],
                        'outro_parentesco' => $dados['grau_parentesco_responsavel_outros'],
                        'tipo_documento' => $dados['tipo_documento_responsavel_entrega'] ?? null,
                        'numero_documento' => $dados['numero_documento_responsavel_entrega'] ?? null,
                        'endereco_id' => $enderecoResponsavel->id,
                        //                        'nacionalidade' => $dados['nacionalidade_responsavel_2'] ?? null,
                    ]);
                }

                //caso responsavel pela entrega seja diferente do responsavel do corpo
                else if ($dados['responsavel_entrega_igual'] == 0) {
                    $responsavelCorpo = Responsavel::create([
                        'nome' => $dados['nome_responsavel'],
                        'rg' => $dados['rg_responsavel'] ?? null,
                        'orgao_emissor' => $dados['orgao_emissor_responsavel'] ?? null,
                        'estado_rg' => $dados['estado_rg_responsavel_corpo'] ?? null,
                        'cpf' => $dados['cpf_responsavel'] ?? null,
                        'parente' => 1,
                        'telefone' => $dados['telefone_responsavel'],
                        'grau_parentesco' => $dados['grau_parentesco_responsavel'],
                        'outro_parentesco' => $dados['grau_parentesco_responsavel_outro'],
                        'tipo_documento' => $dados['tipo_documento_responsavel'] ?? null,
                        'numero_documento' => $dados['numero_documento_responsavel'] ?? null,
                        'endereco_id' => $enderecoResponsavel->id,
                        //                        'nacionalidade' => $dados['nacionalidade_responsavel'] ?? null,

                    ]);
                }
            }
            // caso responsavel pela Retirada seja diferente do responsavel do corpo
            if (isset($enderecoResponsavelEntrega)) {
                $responsavelRetirada = Responsavel::create([
                    'nome' => $dados['nome_responsavel_entrega'],
                    'rg' => $dados['rg_responsavel_entrega'],
                    'orgao_emissor' => $dados['orgao_emissor_responsavel_entrega'],
                    'estado_rg' => $dados['estado_rg_responsavel_entrega'],
                    'cpf' => $dados['cpf_responsavel_entrega'] ?? null,
                    'parente' => 0,
                    'telefone' => $dados['telefone_responsavel_entrega'],
                    'grau_parentesco' => null,
                    'tipo_documento' => $dados['tipo_documento_responsavel_entrega'] ?? null,
                    'numero_documento' => $dados['numero_documento_responsavel_entrega'] ?? null,
                    'endereco_id' => $enderecoResponsavelEntrega->id,

                ]);
            }

            //Cadastrar o corpo
            $corpo =  new Corpo([
                'nome' => $dados['nome_corpo'],
                'sexo' => $dados['sexo_corpo'],
                'natimorto' => $dados['natimorto'],
                'status' => $dados['pendencias'] == 0 ? 1 : 4,
                'status_anterior' => 1,
                'rg' => $dados['rg_corpo'] ?? null,
                'orgao_emissor' => $dados['orgao_emissor_corpo'] ?? null,
                'estado_rg' => $dados['estado_rg'] ?? null,
                'estabelecimento_obito' => $nome_estabelecimento,
                'cnes_estabelecimento' => $cnes_estabelecimento,
                'situacao' => $situacao,
                'cpf' => $dados['cpf_corpo'] ?? null,
                'endereco_corpo_id' => $enderecoCorpo->id,
                'data_entrada' => $dados['data_entrada'],
                'data_obito' => $dados['data_obito'],
                'data_nascimento' => isset($dados['data_nascimento']) ? Carbon::createFromFormat('d/m/Y', $dados['data_nascimento'])->format('Y-m-d') : null,
                'local_obito' => $dados['local_obito'],
                'endereco_obito_id' => $enderecoObito->id,
                'meio_transporte' => $dados['meio_transporte'] ?? null,
                'meio_transporte_outro' => $dados['meio_transporte_outro'] ?? null,
                'funeraria_id' => $dados['funeraria'] ?? null,
                'responsavel_entrega_id' => isset($responsavelRetirada) ? $responsavelRetirada->id : null,
                'responsavel_corpo_id' => isset($responsavelCorpo) ? $responsavelCorpo->id : null,
                'necrotomista_id' => null,
                'pendencias' => $dados['pendencias'],
                'observacoes' => $dados['observacoes'],
                'corposera' => isset($dados['corpoSera']) ? $dados['corpoSera'] : null,
                'nacionalidade' => $dados['nacionalidade'] ?? null,
                'cadastradoPor' =>  $dados['escrivao_id'] ?? Auth::user()->id,
                'tipo_documento' => $dados['tipo_documento'] ?? null,
                'numero_documento' => $dados['numero_documento'] ?? null,
                'destino_do_corpo' => $dados['destino_do_corpo'] ?? null,
                'data_recebimento' => $dados['data_recebimento'] ?? null,
                'digitador_id' => null,

            ]);

            if (isset($dados['escrivao_id']) != null) {
                $corpo->digitador_id = Auth::user()->id;
            }

            $corpo->save();

            $users = User::all();
            if ($dados['pendencias'] != 0) {
                Notification::send($users, new SystemNotification('warning', 'Corpo #' . $corpo->id . ' possui pendências', 'Um corpo possui pendências #' . $corpo->id, 'Corpo de id #' . $corpo->id . 'possui pendências', Auth::user()->id, 'bi bi-person-rolodex'));
            }

            $dados = [
                'titulo' => 'Entrada do corpo',
                'conteudo' => 'Foi dado entrada no corpo de ' . $dados['nome_corpo'] . ' e foi preenchido por ' . Auth::user()->name . ' às ' . Carbon::parse($dados['data_entrada'])->format('H:i'),
                'icon' => 'bi-person',
                'corpo_id' => $corpo->id,
            ];
            $historico = HistoricoCorpo::create($dados);
            return redirect()->route('corpos.index')->with('success', 'Corpo cadastrado com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput($request->all());
        }
    }

    /**
     * Edit possui a função de editar os dados de um corpo.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $corpo = Corpo::findOrFail($id);
        $funerarias = Funeraria::all();
        $orgaos_emissores = OrgaoEmissor::all();
        $usuarios = User::role('Recepção')->get();

        //tempo para poder editar o corpo de 15 dias
        $data_atual = Carbon::now();
        $data_finalizacao = Carbon::parse($corpo->data_finalizacao);
        $diferenca = $data_atual->diffInDays($data_finalizacao);

        // if ($corpo->status == 6 and $diferenca > 15) {
        //     return redirect()->route('corpos.index', $id)->with('error', 'Esse corpo já foi Finalizado.');
        // }
        return view('corpos.edit', compact('corpo', 'funerarias', 'orgaos_emissores', 'usuarios'));
    }

    /**
     * Edit possui a função de editar os dados de um corpo.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update($id, Request $request)
    {
        $dados = request()->all();

        $corpoDados = Corpo::find($id);
        $status = $corpoDados->status;

        if (isset($dados['natimorto'])) {
            $dados['natimorto'] = $dados['natimorto'] == "1" ? 1 : 0;
            if ($dados['natimorto'] == 1) {
                unset($dados['data_nascimento']);
            }
        } else {
            $dados['natimorto'] = 0;
        }

        //verifica se o cpf  do corpo é valido
        if ($request->has('cpf_corpo')) {
            if (!UtilsHelpers::validaCPF($request->cpf_corpo)) {
                return back()->with('error', 'CPF do corpo inválido')->withInput($request->all());
            }
        }

        //verifica se o cpf do responsavel da entrega do corpo é valido
        if ($request->has('cpf_responsavel_entrega')) {
            if (!UtilsHelpers::validaCPF($request->cpf_responsavel_entrega)) {
                return back()->with('error', 'CPF do responsavel da entrega inválido')->withInput($request->all());
            }
        }

        //verifica se o cpf do responsavel do corpo é valido
        if ($request->has('cpf_responsavel')) {
            if (!UtilsHelpers::validaCPF($request->cpf_responsavel)) {
                return back()->with('error', 'CPF do responsavel do corpo inválido')->withInput($request->all());
            }
        }

        //verifica o tipo de documento do corpo
        if ($request->tipo_documento == 'RG') {
            if (empty($request->rg_corpo)) {
                return back()->with('error', 'É necessário informar o RG do CORPO')->withInput($request->all());
            }
            if (empty($request->orgao_emissor_corpo)) {
                return back()->with('error', 'É necessário informar o Órgão Emissor do RG do CORPO')->withInput($request->all());
            }
            if (empty($request->estado_rg)) {
                return back()->with('error', 'É necessário informar a UF do RG do CORPO')->withInput($request->all());
            }
            $dados['orgao_emissor_corpo'] = $request->orgao_emissor_corpo;
            $dados['estado_rg'] = $request->estado_rg;
        } elseif ($request->tipo_documento != 'RG' && $request->tipo_documento != 'Nao Possui') {
            if (empty($request->numero_documento)) {
                return back()->with('error', 'É necessário informar o número do documento do CORPO')->withInput($request->all());
            }
            $dados['rg_corpo'] = null;
            $dados['orgao_emissor_corpo'] = null;
            $dados['estado_rg'] = null;
        } elseif ($request->tipo_documento == 'Nao Possui') {
            $dados['numero_documento'] = null;
            $dados['rg_corpo'] = null;
            $dados['orgao_emissor_corpo'] = null;
            $dados['estado_rg'] = null;
        }

        //verifica o tipo de documento do responsavel pela entrega
        if ($request->tipo_documento_responsavel_entrega == 'RG') {
            if (empty($request->rg_responsavel_entrega)) {
                return back()->with('error', 'É necessário informar o RG do RESPONSÁVEL PELA ENTREGA')->withInput($request->all());
            }
            if (empty($request->orgao_emissor_responsavel_entrega)) {
                return back()->with('error', 'É necessário informar o Órgão Emissor do RG do RESPONSÁVEL PELA ENTREGA')->withInput($request->all());
            }
            if (empty($request->estado_rg_responsavel_entrega)) {
                return back()->with('error', 'É necessário informar a UF do RG do RESPONSÁVEL PELA ENTREGA')->withInput($request->all());
            }
        } elseif ($request->tipo_documento_responsavel_entrega != 'RG' && $request->tipo_documento_responsavel_entrega != 'Nao Possui') {
            if (empty($request->numero_documento_responsavel_entrega)) {
                return back()->with('error', 'É necessário informar o número do documento do RESPONSÁVEL PELA ENTREGA')->withInput($request->all());
            }
        }

        //verifica o tipo de documento do responsavel pelo corpo
        if ($request->tipo_documento_responsavel == 'RG') {
            if (empty($request->rg_responsavel)) {
                return back()->with('error', 'É necessário informar o RG do RESPONSÁVEL PELO CORPO')->withInput($request->all());
            }
            if (empty($request->orgao_emissor_responsavel)) {
                return back()->with('error', 'É necessário informar o Órgão Emissor do RG do RESPONSÁVEL PELO CORPO')->withInput($request->all());
            }
            if (empty($request->estado_rg_responsavel_corpo)) {
                return back()->with('error', 'É necessário informar a UF do RG do RESPONSÁVEL PELO CORPO')->withInput($request->all());
            }
        } elseif ($request->tipo_documento_responsavel != 'RG' && $request->tipo_documento_responsavel != 'Nao Possui') {
            if (empty($request->numero_documento_responsavel)) {
                return back()->with('error', 'É necessário informar o número do documento do RESPONSÁVEL PELO CORPO')->withInput($request->all());
            }
        }

        // $obito_corpo = new DateTime($dados['data_obito']);
        // $time = "365";
        // $data_atual = (new DateTime())->modify('-' . $time . ' day');
        // if ($obito_corpo < $data_atual) {
        //     return back()->with('error', 'Data de óbito menor que um ano atras')->withInput($request->all());
        // }
        //verifica se a data do obito é maior que a data atual
        $dtObito = Carbon::createFromFormat('d/m/Y H:i', $request->data_obito)->format('Y-m-d H:i:s');
        $obito_corpo = new DateTime($dtObito);
        $data_atual = new DateTime();
        if ($obito_corpo > $data_atual) {
            return back()->with('error', 'Data de óbito invalida')->withInput($request->all());
        }
        //verifica se a data de nascimento é menor que o ano 1850
        if (isset($dados['natimorto']) == 0) {
            $dtNasc = Carbon::createFromFormat('d/m/Y', $dados['data_nascimento'])->format('Y-m-d');
            $nascimento_corpo = new DateTime($dtNasc);
            $max_nascimento = new DateTime('1850-01-01');
            if ($nascimento_corpo < $max_nascimento) {
                return back()->with('error', 'Data de nascimento invalida')->withInput($request->all());
            }
            //verificar se a data de obito é maior que a de nascimento
            if ($obito_corpo < $nascimento_corpo) {
                return back()->with('error', 'Data de óbito menor que a data de nascimento')->withInput($request->all());
            }
        }

        if (empty($request->justificativa) && $corpoDados->status == 6) {
            throw ValidationException::withMessages(['justificativa' => 'A justificativa é obrigatória.']);
        }
        //Cadastrar os endereços


        $enderecoCorpo = Endereco::find($corpoDados->enderecoCorpo->id);
        $enderecoCorpo->update([
            'logradouro' => $dados['logradouro_corpo'],
            'numero' => $dados['numero_corpo'],
            'complemento' => $dados['complemento_corpo'],
            'bairro' => $dados['bairro_corpo'] ?? null,
            'cidade' => $dados['cidade_corpo'] ?? null,
            'estado' => $dados['estado_corpo'] ?? null,
            'cep' => $dados['cep_corpo'] ?? null,
            'corpo_id' => $corpoDados->id,
            'pais' => $dados['nacionalidade'] ?? null,
            'endereco_postal' => $dados['endereco_postal_corpo'] ?? null,
        ]);


        $enderecoObito = Endereco::find($corpoDados->enderecoObito->id)->update([
            'logradouro' => $dados['logradouro_obito'],
            'numero' => $dados['numero_obito'],
            'complemento' => $dados['complemento_obito'],
            'bairro' => $dados['bairro_obito'],
            'cidade' => $dados['cidade_obito'],
            'estado' => $dados['estado_obito'],
            'cep' => $dados['cep_obito'],
            'corpo_id' => $corpoDados->id,
        ]);

        $enderecoResponsavelEntrega = Endereco::find($corpoDados->responsavelEntrega->endereco->id)->update([
            'logradouro' => $dados['logradouro_responsavel_entrega'],
            'numero' => $dados['numero_responsavel_entrega'],
            'complemento' => $dados['complemento_responsavel_entrega'],
            'bairro' => $dados['bairro_responsavel_entrega'],
            'cidade' => $dados['cidade_responsavel_entrega'],
            'estado' => $dados['estado_responsavel_entrega'],
            'cep' => $dados['cep_responsavel_entrega'],
            'corpo_id' => $corpoDados->id,

        ]);
        if ($corpoDados->responsavel_corpo_id != null) {
            $enderecoResponsavel = Endereco::find($corpoDados->responsavelCorpo->endereco->id)->update([
                'logradouro' => $dados['logradouro_responsavel'],
                'numero' => $dados['numero_responsavel'],
                'complemento' => $dados['complemento_responsavel'],
                'bairro' => $dados['bairro_responsavel'],
                'cidade' => $dados['cidade_responsavel'],
                'estado' => $dados['estado_responsavel'],
                'cep' => $dados['cep_responsavel'],
                'corpo_id' => $corpoDados->id,
            ]);
        }

        //Cadastrar os responsáveis

        if (isset($enderecoResponsavel)) {
            $responsavelCorpo = Responsavel::find($dados['responsavel_corpo_id'])->update([
                'nome' => $dados['nome_responsavel'],
                'rg' => $dados['rg_responsavel'] ?? null,
                'sexo' => $dados['sexo_responsavel'],
                'orgao_emissor' => $dados['orgao_emissor_responsavel'] ?? null,
                'estado_rg' => $dados['estado_rg_responsavel_corpo'] ?? null,
                'cpf' => $dados['cpf_responsavel'] ?? null,
                'parente' => 1,
                'telefone' => $dados['telefone_responsavel'],
                'grau_parentesco' => $dados['grau_parentesco_responsavel'],
                'outro_parentesco' => $dados['grau_parentesco_responsavel_outro'] ?? null,
                'tipo_documento' => $dados['tipo_documento_responsavel'] ?? null,
                'numero_documento' => $dados['numero_documento_responsavel'] ?? null,
                'endereco_id' => $corpoDados->responsavelCorpo->endereco->id,
                //                'nacionalidade' => $dados['nacionalidade_responsavel'] ?? null,
                'corpo_id' => $corpoDados->id,
            ]);
        }

        if (isset($enderecoResponsavelEntrega)) {
            $responsavelRetirada = Responsavel::find($dados['responsavel_entrega_id'])->update([
                'nome' => $dados['nome_responsavel_entrega'],
                'rg' => $dados['rg_responsavel_entrega'] ?? null,
                'sexo' => $dados['sexo_responsavel_entrega'] ?? null,
                'orgao_emissor' => $dados['orgao_emissor_responsavel_entrega'] ?? null,
                'estado_rg' => $dados['estado_rg_responsavel_entrega'] ?? null,
                'cpf' => $dados['cpf_responsavel_entrega'] ?? null,
                'parente' => 0,
                'telefone' => $dados['telefone_responsavel_entrega'],
                'grau_parentesco' => null,
                'tipo_documento' => $dados['tipo_documento_responsavel_entrega'] ?? null,
                'numero_documento' => $dados['numero_documento_responsavel_entrega'] ?? null,
                'endereco_id' => $corpoDados->responsavelEntrega->endereco->id,
                'corpo_id' => $corpoDados->id,
            ]);
        }

        if ($dados['pendencias'] != 0 && $corpoDados->status != 4) {
            $statusAnterior = $corpoDados->status;
            $status = 4;
        }
        if ($dados['pendencias'] == 0) {
            $status = $corpoDados->status_anterior;
        }

        if ($dados['local_obito'] == "Outros" || $dados['local_obito'] == "Via pública") {
            if (empty($dados['situacao'])) {
                return back()->with('error', 'O campo Situação é obrigatório!')->withInput($request->all());
            }
            $situacao = $dados['situacao'];
        }

        //Cadastrar o corpo
        $corpo = Corpo::find($id)->update([
            'nome' => $dados['nome_corpo'],
            'sexo' => $dados['sexo_corpo'],
            'status' => $status,
            'data_nascimento' => isset($dados['data_nascimento']) ? Carbon::createFromFormat('d/m/Y', $dados['data_nascimento'])->format('Y-m-d') : null,
            'status_anterior' => isset($statusAnterior) ? $statusAnterior : $corpoDados->status_anterior,
            'rg' => $dados['rg_corpo'] ?? $dados['numero_documento'] ?? null,
            'orgao_emissor' => $dados['orgao_emissor_corpo'] ?? null,
            'estado_rg' => $dados['estado_rg'] ?? null,
            'meio_transporte' => $dados['meio_transporte'] ?? null,
            'meio_transporte_outro' => $dados['meio_transporte_outro'] ?? null,
            'cpf' => $dados['cpf_corpo'] ?? null,
            'data_obito' =>  isset($dados['data_obito']) ? Carbon::createFromFormat('d/m/Y H:i',  $dados['data_obito'])->format('Y-m-d H:i:s') : null,
            'local_obito' => isset($dados['local_obito']) ? $dados['local_obito'] : "",
            'funeraria_id' => $dados['funeraria'] ?? null,
            'funeraria_retirada_id' => $dados['funeraria_retirada_id'] ?? null,
            'corpoSera' => isset($dados['corpoSera']) ? $dados['corpoSera'] : null,
            'pendencias' => $dados['pendencias'],
            'observacoes' => $dados['observacoes'],
            'natimorto' => $dados['natimorto'],
            'estabelecimento_obito' => $dados['estabelecimento_obito'] ?? '',
            'cnes_estabelecimento' => $dados['cnes_estabelecimento'] ?? '',
            'situacao' => $situacao ?? '',
            'endereco_corpo_id' => $enderecoCorpo->id,
            'tipo_documento' => $dados['tipo_documento'] ?? null,
            'numero_documento' => $dados['numero_documento'] ?? null,
            'destino_do_corpo' => $dados['destino_do_corpo'] ?? null,
            'num_vo' => $dados['num_vo'] ?? null,
            'ano_vo' => $dados['ano_vo'] ?? null,
            'nacionalidade' => $dados['nacionalidade'] ?? null,
            'data_recebimento' => $dados['data_recebimento'] ?? null,
            'cadastradoPor' => $dados['escrivao_id'] ?? Auth::user()->id,
        ]);

        $users = User::all();
        if ($dados['pendencias'] != 0) {
            Notification::send($users, new SystemNotification('warning', 'Corpo #' . $id . ' possui pendências', 'Um corpo possui pendências #' . $id, 'Corpo de id #' . $id . 'possui pendências', Auth::user()->id, 'bi bi-person-rolodex'));
        }
        if ($corpo) {
            return redirect()->route('corpos.index')->with('success', 'Dados editados com sucesso!');
        }
    }

    /**
     * Show possui a função de mostrar os dados de um corpo.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $user = Auth::user();
        $corpo = Corpo::findOrFail($id);
        $historico = HistoricoCorpo::where('corpo_id', $corpo->id)->get();
        $ano_vo = Carbon::now()->format('Y');
        $num_vo = Corpo::where('ano_vo', '=', $ano_vo)->whereNotNull('num_vo')->orderBy('num_vo', 'desc')->first()?->num_vo + 1 ?? 1;
        $unidades = Unidade::select('id', 'nome')->get();
        $destino = Unidade::select('nome')->where('id', $corpo->estabelecimento_destino)->first();

        $justificativa = Justificativa::where('corpo_id', $corpo->id)->orderBy('id', 'desc')->get();
        $nomeID = $justificativa->pluck('user_id')->unique();
        $nome = User::whereIn('id', $nomeID)->pluck('name', 'id');
        /*
        select 
        u.name,
        a.event, 
        a.created_at, 
        a.updated_at 
        from audits a 
        left join users u on a.user_id = u.id
        where a.auditable_type like '%Corpo%' 
        and a.auditable_id = 100 
        order by a.created_at asc;
        */
        return view('corpos.show', compact('corpo', 'historico', 'num_vo', 'ano_vo', 'user', 'unidades', 'destino', 'justificativa', 'nome'));
    }

    /**
     * receberCorpo
     *
     * @param  mixed $id
     * @param  mixed $request
     * @return void
     */
    public function receberCorpo($id, Request $request)
    {
        $corpo = Corpo::findOrFail($id);
        $corpo->pertences = $request->pertences;
        $corpo->necrotomista_id = Auth::user()->id;

        if ($corpo->status == 1) {
            $corpo->status = 2;
            $corpo->status_anterior = 2;
        }
        if ($corpo->status == 3) {
            $corpo->status = 2;
            $corpo->status_anterior = 3;
        }
        if ($corpo->status == 5) {
            $corpo->status = 2;
            $corpo->status_anterior = 5;
        }
        if ($corpo->save()) {
            $dados = [
                'titulo' => 'Corpo recebido pelo necrotomista',
                'conteudo' => 'O corpo foi recebido pelo necrotomista ' . Auth::user()->name . ' às ' . Carbon::now()->format('H:i'),
                'icon' => 'bi-person-check-fill',
                'corpo_id' => $corpo->id,
            ];
            $historico = HistoricoCorpo::create($dados);
            return redirect()->route('corpos.index')->with('success', 'Corpo recebido com sucesso!');
        }
    }

    /**
     * adicionarResponsavelCorpo
     * Função para mostrar a view do formulário do responsável pelo corpo
     *
     * @param  mixed $id
     * @return void
     */
    public function adicionarResponsavelCorpo($id)
    {
        $corpo = Corpo::find($id);
        if ($corpo->responsavel_corpo_id != null) {
            return redirect()->route('corpos.show', $id)->with('error', 'Já existe um responsável cadastro para esse corpo.');
        }
        $orgaos_emissores = OrgaoEmissor::all();
        return view('corpos.informar-responsavel-corpo', compact('corpo', 'orgaos_emissores'));
    }

    /**
     * adicionarResponsavelCorpoStore
     * Função para adicionar uma responsável pelo corpo, quando ele possui o status de não estar presente
     *
     * @param  mixed $request
     * @return void
     */
    public function adicionarResponsavelCorpoStore(Request $request)
    {
        $dados = $request->all();

        $corpo = Corpo::find($request->corpo_id);

        if ($corpo->responsavel_corpo_id != null) {
            return redirect()->route('corpos.show', $request->corpo_id)->with('error', 'Já existe um responsável cadastrado para esse corpo.');
        }

        $enderecoResponsavel = Endereco::create([
            'logradouro' => $dados['logradouro_responsavel'],
            'numero' => $dados['numero_responsavel'],
            'complemento' => $dados['complemento_responsavel'],
            'bairro' => $dados['bairro_responsavel'],
            'cidade' => $dados['cidade_responsavel'],
            'estado' => $dados['estado_responsavel'],
            'cep' => $dados['cep_responsavel'],
        ]);

        $responsavelCorpo = Responsavel::create([
            'nome' => $dados['nome_responsavel'],
            'rg' => $dados['rg_responsavel'],
            'orgao_emissor' => $dados['orgao_emissor_responsavel'] ?? null,
            'cpf' => $dados['cpf_responsavel'] ?? null,
            'parente' => 1,
            'telefone' => $dados['telefone_responsavel'],
            'grau_parentesco' => $dados['grau_parentesco_responsavel'],
            'endereco_id' => $enderecoResponsavel->id,
        ]);

        $corpo->update([
            'responsavel_corpo_id' => $responsavelCorpo->id
        ]);

        $dadosHistorico = [
            'titulo' => 'Responsável atribuído',
            'conteudo' => 'O responsável pelo corpo foi atribúido por ' . Auth::user()->name . ' às ' . Carbon::now()->format('H:i'),
            'icon' => 'bi-file-person-fill',
            'corpo_id' => $corpo->id,
        ];
        $historico = HistoricoCorpo::create($dadosHistorico);

        return redirect()->route('corpos.show', $request->corpo_id)->with('success', 'Responsável cadastrado com sucesso!');
    }

    /**
     * medicoExterno
     * Função para mostrar o formulário do médico externo
     *
     * @param  mixed $id
     * @return void
     */
    public function medicoExterno($id)
    {
        $corpo = Corpo::findOrFail($id);
        return view('corpos.medicoexterno', compact('corpo'));
    }


    /**
     * inserirMedicoExterno
     * Função para atribuir um médico externo ao corpo
     *
     * @param  mixed $request
     * @return void
     */
    public function inserirMedicoExterno(Request $request)
    {
        $this->validate($request, [
            'nome' => 'required',
            'crm' => 'required',
            'telefone' => 'required',
        ]);
        $endereco = Endereco::where('cep', $request->cep)->where('numero', $request->numero)->first();
        if (!$endereco) {
            $endereco = Endereco::create([
                "cep" => $request->cep,
                "logradouro" => $request->logradouro,
                "numero" => $request->numero,
                "complemento" => $request->complemento,
                "bairro" => $request->bairro,
                "cidade" => $request->cidade,
                "estado" => $request->estado,
            ]);
        }

        $medicoExterno = MedicoExterno::create([
            "nome" => $request->nome,
            "crm" => $request->crm,
            "telefone" => $request->telefone,
            "endereco_id" => $endereco->id,

        ]);

        $corpo = Corpo::find($request->corpo_id);
        $corpo->medico_externo = $medicoExterno->id;
        $corpo->status = 8;
        $corpo->status_anterior = 8;
        $corpo->save();

        $dados = [
            'titulo' => 'Médico externo atribuído',
            'conteudo' => 'O médico ' . $request->nome . ' foi atribuido ao corpo às ' . Carbon::now()->format('H:i'),
            'icon' => 'bi-person-rolodex',
            'corpo_id' => $corpo->id,
        ];
        $historico = HistoricoCorpo::create($dados);

        return redirect()->route('corpos.show', $request->corpo_id)->with('success', 'Médico externo inserido com sucesso!');
    }

    public function destroy($id)
    {
        $corpo = Corpo::findOrFail($id);
        $entrevista = Entrevista::where('corpo_id', $corpo->id)->first();
        if ($entrevista) {
            $entrevista->delete();
        }
        $exames = Exame::where('corpo_id', $corpo->id)->get();
        if ($exames) {
            foreach ($exames as $exame) {
                $exame->delete();
            }
        }
        $laudos = Laudo::where('id_corpo', $corpo->id)->get();
        if ($laudos) {
            foreach ($laudos as $laudo) {
                $laudo->delete();
            }
        }
        $corpo->entrevista_id = null;
        $corpo->delete();
        return redirect()->back()->with('success', 'Corpo excluído com sucesso!');
    }
}
