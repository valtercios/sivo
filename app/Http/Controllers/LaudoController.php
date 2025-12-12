<?php

namespace App\Http\Controllers;

use App\Models\Causas;
use App\Models\Corpo;
use App\Models\HistoricoCorpo;
use App\Models\Laudo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class LaudoController extends Controller
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        DB::enableQueryLog();
        $this->middleware('permission:laudos_view', ['only' => ['index', 'show']]);
        $this->middleware('permission:laudos_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:laudos_delete', ['only' => ['destroy']]);
        $this->middleware('permission:laudos_edit', ['only' => ['edit', 'update']]);
    }

    /**
     * index
     * Função que lista os laudos
     *
     * @return void
     */
    public function index(Request $request)
    {
        $laudos = Laudo::select('laudos.*')
            ->with(['corpo', 'laudoStatus'])
            ->leftJoin('corpos', 'laudos.id_corpo', '=', 'corpos.id')
            ->leftJoin('laudo_status', 'laudos.status', '=', 'laudo_status.id');
        
        // Filtrar por nome do corpo
        if ($request->nomeCorpo) {
             $laudos = $laudos->whereHas('corpo', function ($q) use ($request) {
                $q->where('nome', 'like', '%' . strtoupper($request->nomeCorpo) . '%');
            });
        }

        $sort = $request->get('sort', 'laudos.created_at');
        $direction = $request->get('direction', 'desc');

        $sortMapping = [
            'id' => 'laudos.id',
            'corpo_nome' => 'corpos.nome',
            'corpo_rg' => 'corpos.rg',
            'corpo_cpf' => 'corpos.cpf',
            'created_at' => 'laudos.created_at',
            'status' => 'laudo_status.descricao',
        ];

        if (array_key_exists($sort, $sortMapping)) {
            $sortColumn = $sortMapping[$sort];
        } else {
            $sortColumn = 'laudos.created_at';
        }

        $laudos = $laudos->orderBy($sortColumn, $direction)->paginate(10);
        
        return view('laudos.index', compact('laudos'));
    }
    /**
     * show
     * Função que mostra os detalhes de um laudo
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        // Carregar o laudo junto com o histórico e os usuários relacionados
        $laudo = Laudo::with(['historicoLaudo.user'])->find($id);
        $medico = User::find($laudo->medico);
        
        // Inicializar arrays para armazenar os dados processados
        $new = [];
        $old = [];
        $user = [];
        $data = [];
        // Iterar sobre o histórico do laudo uma única vez
        foreach ($laudo->historicoLaudo as $h) {
            $new[] = $this->renameKeys(json_decode($h->new_values, true));
            $old[] = $this->renameKeys(json_decode($h->old_values, true));
            $user[] = $h->user->name;
            $data[] = $h->updated_at->format('d/m/Y');
        }
        return view('laudos.show', compact('laudo', 'medico', 'new', 'old', 'user', 'data'));
    }

    private function renameKeys($array)
    {
        $keys = [
            "historico" => "Histórico",
            "exame_geral" => "Exame Geral",
            "exame_cabeca" => "Exame Cabeça",
            "exame_abdome" => "Exame Abdome",
            "exame_genitalia" => "Exame Genitalia",
            "exame_membros" => "Exame Membros",
            "exame_macroscopia" => "Exame Macroscopia",
            "exame_microscopia" => "Exame Microscopia",
            "exame_torax" => "Exame Tórax",
        ];
        return array_combine(array_map(function ($key) use ($keys) {
            return $keys[$key] ?? $key;
        }, array_keys($array)), $array);
    }
    
    /**
     * selecionarCorpo
     * Função que mostra a view para seleção de corpo para criação de um laudo
     *
     * @return void
     */
    public function selecionarCorpo()
    {
        $corpos = Corpo::whereNotNull('entrevista_id')->whereNull('laudo')->where('medico_externo', '=', '0')->get();
        return view('laudos.selecionar-corpo', compact('corpos'));
    }
    /**
     * create
     * Função que mostra o formulário de criação do laudo
     *
     * @param  mixed $id
     * @return void
     */
    public function create($id)
    {
        $corpo = Corpo::findOrFail($id);
        $corpo->load('entrevistaInfo.ocupacao');
        $usuarios = User::role('Médico')->get();
        $flag_laudo = true;
        if ($corpo->laudo != null || $corpo->laudo != 0) {
            return redirect()->route('laudos.index', compact('corpo'))->with('error', 'Já possui um laudo cadastrado para esse corpo.');
        }
        if ($corpo->medico_externo == 1) {
            return redirect()->route('laudos.index', compact('corpo'))->with('error', 'Não é possível inserir as informações do laudo. Pois o corpo possui médico externo.');
        }
        return view('laudos.informacoes-medicas', compact('id', 'corpo', 'usuarios', 'flag_laudo'));
    }
    /**
     * store
     * Função que cria o laudo
     *
     * @param  mixed $id
     * @param  mixed $request
     * @return void
     */
    public function store($id, Request $request)
    {


        try{
        $corpo = Corpo::find($id);
        $dados = [
            'titulo' => 'Laudo preenchido',
            'conteudo' => 'O laudo foi preenchido pelo médico(a) ' . auth()->user()->name . ' às ' . Carbon::now()->format('H:i'),
            'icon' => 'bi-file-earmark-person',
            'corpo_id' => $corpo->id,
        ];
        $historico = HistoricoCorpo::create($dados);

        if ($request->encaminhar_itep == '1') {
            $corpo->status = 7;
            $corpo->status_anterior = 7;
            $corpo->encaminhar_itep = 1;
            $dados = [
                'titulo' => 'Encaminhado ao ITEP',
                'conteudo' => 'O corpo do falecido(a) ' . $corpo->name . ' foi encaminhado ao ITEP às ' . Carbon::now()->format('H:i'),
                'icon' => 'bi-file-earmark-person',
                'corpo_id' => $corpo->id,
            ];
            $historico = HistoricoCorpo::create($dados);
        } else {
            $corpo->status = $request->status_corpo;
            $corpo->status_anterior = $request->status_corpo;
            if ($request->status_corpo == 6) {
                $corpo->data_finalizacao = Carbon::now();
            }
        }

        if ($request->causa_a_descricao) {
            $causa_a = Causas::create([
                'descricao' => $request->causa_a_descricao,
                'tempo' => $request->causa_a_tempo,
                'tipo_tempo' => $request->causa_a_tipo_tempo,
                'cid' => $request->causa_a_cid,
            ]);
        }
        if ($request->causa_b_descricao) {
            $causa_b = Causas::create([
                'descricao' => $request->causa_b_descricao,
                'tempo' => $request->causa_b_tempo,
                'tipo_tempo' => $request->causa_b_tipo_tempo,
                'cid' => $request->causa_b_cid,
            ]);
        }
        if ($request->causa_c_descricao) {
            $causa_c = Causas::create([
                'descricao' => $request->causa_c_descricao,
                'tempo' => $request->causa_c_tempo,
                'tipo_tempo' => $request->causa_c_tipo_tempo,
                'cid' => $request->causa_c_cid,
            ]);
        }
        if ($request->causa_d_descricao) {
            $causa_d = Causas::create([
                'descricao' => $request->causa_d_descricao,
                'tempo' => $request->causa_d_tempo,
                'tipo_tempo' => $request->causa_d_tipo_tempo,
                'cid' => $request->causa_d_cid,
            ]);
        }
        if ($request->causa_extra1_descricao) {
            $causa_extra1 = Causas::create([
                'descricao' => $request->causa_extra1_descricao,
                'tempo' => $request->causa_extra1_tempo,
                'tipo_tempo' => $request->causa_extra1_tipo_tempo,
                'cid' => $request->causa_extra1_cid,
            ]);
        }
        if ($request->causa_extra2_descricao) {
            $causa_extra2 = Causas::create([
                'descricao' => $request->causa_extra2_descricao,
                'tempo' => $request->causa_extra2_tempo,
                'tipo_tempo' => $request->causa_extra2_tipo_tempo,
                'cid' => $request->causa_extra2_cid,
            ]);
        }

        $laudo = new Laudo([
            'id_corpo' => $corpo->id,
            'entrevista_id' => $corpo->entrevista_id,
            'medico' => auth()->user()->id,
            'historico' => isset($request->historico) ? $request->historico : null,
            'exame_geral' => isset($request->exame_geral) ? $request->exame_geral : null,
            'exame_cabeca' => isset($request->exame_cabeca) ? $request->exame_cabeca : null,
            'exame_torax' => isset($request->exame_torax) ? $request->exame_torax : null,
            'exame_abdome' => isset($request->exame_abdome) ? $request->exame_abdome : null,
            'exame_genitalia' => isset($request->exame_genitalia) ? $request->exame_genitalia : null,
            'exame_membros' => isset($request->exame_membros) ? $request->exame_membros : null,
            'exame_macroscopia' => isset($request->exame_macroscopia) ? $request->exame_macroscopia : null,
            'exame_microscopia' => isset($request->exame_microscopia) ? $request->exame_microscopia : null,
            'exame_conclusoes' => isset($request->exame_conclusoes) ? $request->exame_conclusoes : null,
            'causa_a_id' => isset($causa_a->id) ? $causa_a->id : null,
            'causa_b_id' => isset($causa_b->id) ? $causa_b->id : null,
            'causa_c_id' => isset($causa_c->id) ? $causa_c->id : null,
            'causa_d_id' => isset($causa_d->id) ? $causa_d->id : null,
            'causa_outras1_id' => isset($causa_extra1->id) ? $causa_extra1->id : null,
            'causa_outras2_id' => isset($causa_extra2->id) ? $causa_extra2->id : null,
            'data_exame' => $request->data_exame,
            'status' => $request->status_laudo,
        ]);

        if ($request->hasFile('anexo')) {
            $extensao = $request->file('anexo')->getClientOriginalExtension();
            $nomeArquivo = 'laudo_' . Str::uuid() . '.' . $extensao;
            $caminho = $request->file('anexo')->storeAs('laudos', $nomeArquivo, 'public');

            $laudo->file_path = $caminho;
            $laudo->file_name = $nomeArquivo;
        }


        if (isset($request->escrivao_id) != null){
            $laudo->medico =  $request->escrivao_id ?? auth()->user()->id;
            $laudo->digitador_id = Auth::user()->id;
        }

        $laudo->save();
        $corpo->laudo = $laudo->id;
        $corpo->save();

        return redirect()->route('laudos.index')->with('success', 'Informações médicas adicionadas com sucesso!');
        }
        catch(\Exception $e){
            Log::error('Erro ao adicionar informações médicas: '.$e->getMessage());
            return redirect()->route('laudos.index')->with('error', 'Erro ao adicionar informações médicas!');
        }
    }
    /**
     * edit
     * Função que mostra o formulário de edição de um laudo
     *
     * @param  mixed $id
     * @return void
     */
    public function edit($id)
    {
        $laudo = Laudo::find($id);
        $corpo = Corpo::find($laudo->id_corpo);
        $ocupacoes = DB::table('tb_ocupacao')->get();
        $usuarios = User::role('Médico')->get();
        

        $status = $corpo->status;

        return view('laudos.edit', compact('corpo', 'laudo', 'ocupacoes', 'usuarios', 'status'));
    }
    /**
     * update
     * Função que atualiza o laudo
     *
     * @param  mixed $request
     * @return void
     */
    public function update(Request $request)
    {
        $info = $request->all();
        $laudo = Laudo::find($request->laudo_id);
        // // if ($laudo->medico != auth()->user()->id) {
        // //     return redirect()->route('laudos.index')->with('warning', 'O laudo só pode ser alterado pelo médico que o preencheu!');
        // // }
        // Verifica a causa A existe e se ela foi deletade ou atuaolizada
        if ($request->causa_a_descricao) {
            $dados = [
                "descricao" => $request->causa_a_descricao,
                "tipo_tempo" => $request->causa_a_tipo_tempo,
                "tempo" => $request->causa_a_tempo,
                "cid" => $request->causa_a_cid,
            ];
            if ($laudo->causa_a_id) {
                Causas::find($laudo->causa_a_id)->update($dados);
            } else {
                $causa_a = Causas::create($dados);
                $info['causa_a_id'] = $causa_a->id;
            }
        } else {
            if ($laudo->causa_a_id) {
                $info['causa_a_id'] = null;
            }
        }
        // Fim verificação

        // Verifica a causa B existe e se ela foi deletade ou atuaolizada
        if ($request->causa_b_descricao) {
            $dados = [
                "descricao" => $request->causa_b_descricao,
                "tipo_tempo" => $request->causa_b_tipo_tempo,
                "tempo" => $request->causa_b_tempo,
                "cid" => $request->causa_b_cid,
            ];
            if ($laudo->causa_b_id) {
                Causas::find($laudo->causa_b_id)->update($dados);
            } else {
                $causa_b = Causas::create($dados);
                $info['causa_b_id'] = $causa_b->id;
            }
        } else {
            if ($laudo->causa_b_id) {
                $info['causa_b_id'] = null;
            }
        }
        // Fim verificação

        // Verifica a causa C existe e se ela foi deletade ou atuaolizada
        if ($request->causa_c_descricao) {
            $dados = [
                "descricao" => $request->causa_c_descricao,
                "tipo_tempo" => $request->causa_c_tipo_tempo,
                "tempo" => $request->causa_c_tempo,
                "cid" => $request->causa_c_cid,
            ];
            if ($laudo->causa_c_id) {
                Causas::find($laudo->causa_c_id)->update($dados);
            } else {
                $causa_c = Causas::create($dados);
                $info['causa_c_id'] = $causa_c->id;
            }
        } else {
            if ($laudo->causa_c_id) {
                $info['causa_c_id'] = null;
            }
        }
        // Fim verificação

        // Verifica a causa D existe e se ela foi deletade ou atuaolizada
        if ($request->causa_d_descricao) {
            $dados = [
                "descricao" => $request->causa_d_descricao,
                "tipo_tempo" => $request->causa_d_tipo_tempo,
                "tempo" => $request->causa_d_tempo,
                "cid" => $request->causa_d_cid,
            ];
            if ($laudo->causa_d_id) {
                Causas::find($laudo->causa_d_id)->update($dados);
            } else {
                $causa_d = Causas::create($dados);
                $info['causa_d_id'] = $causa_d->id;
            }
        } else {
            if ($laudo->causa_d_id) {
                $info['causa_d_id'] = null;
            }
        }
        // Fim verificação

        // Verifica a causa extra 1 existe e se ela foi deletade ou atuaolizada
        if ($request->causa_extra1_descricao) {
            $dados = [
                "descricao" => $request->causa_extra1_descricao,
                "tipo_tempo" => $request->causa_extra1_tipo_tempo,
                "tempo" => $request->causa_extra1_tempo,
                "cid" => $request->causa_extra1_cid,
            ];
            if ($laudo->causa_outras1_id) {
                Causas::find($laudo->causa_outras1_id)->update($dados);
            } else {
                $causa_outras1 = Causas::create($dados);
                $info['causa_outras1_id'] = $causa_outras1->id;
            }
        } else {
            if ($laudo->causa_outras1_id) {
                $info['causa_outras1_id'] = null;
            }
        }
        // Fim verificação

        // Verifica a causa extra 1 existe e se ela foi deletade ou atuaolizada
        if ($request->causa_extra2_descricao) {
            $dados = [
                "descricao" => $request->causa_extra2_descricao,
                "tipo_tempo" => $request->causa_extra2_tipo_tempo,
                "tempo" => $request->causa_extra2_tempo,
                "cid" => $request->causa_extra2_cid,
            ];
            if ($laudo->causa_outras2_id) {
                Causas::find($laudo->causa_outras2_id)->update($dados);
            } else {
                $causa_outras2 = Causas::create($dados);
                $info['causa_outras2_id'] = $causa_outras2->id;
            }
        } else {
            if ($laudo->causa_outras2_id) {
                $info['causa_outras2_id'] = null;
            }
        }
        //verificação do status do laudo e do corpo
        $corpo = Corpo::find($laudo->id_corpo);
        $corpo->status = $request->status_corpo;
        $corpo->status_anterior = $request->status_corpo;
        if ($request->status_corpo == 6) {
            $corpo->data_finalizacao = Carbon::now();
        }
        $info['status'] = $request->status_laudo;
        // Fim verificação
        $laudo = Laudo::find($request->laudo_id);

        
        if($request->escrivao_id != null){
            $info['medico'] = $request->escrivao_id;
        }
        $laudo->update($info);

        return redirect()->route('laudos.index')->with('success', 'Laudo atualizado com sucesso!');
    }

    /**
     * verificaCID
     * Função que calcula a causa básica da morte pelo CID ( Função em desenvolvimento que ainda não está pronta para uso )
     *
     * @return void
     */
    public function verificaCID()
    {
        $cidsInformadas = 'I608/P230/J440/A91';
        $cidsInformadasSplit = explode('/', $cidsInformadas);
        $cidsInformadasSplit = array_reverse($cidsInformadasSplit);
        $naoCausas = 0;
        $causas = 0;
        $primeiraSequencia = null;
        foreach ($cidsInformadasSplit as $key => $cid) {
            # code...
            if (isset($cidsInformadasSplit[$key + 1])) {
                $procurar = DB::table('tb_causa_morte')->where('CO_CID_CAUSADO', $cidsInformadasSplit[$key + 1])->get()->toArray();
                $procurarFiltrado = array_filter($procurar, function ($item) use ($cid) {
                    return $cid >= $item->CO_CID_INICIAL == $cid && $cid <= $item->CO_CID_FINAL;
                });
                //array filter

                if (count($procurarFiltrado) > 0) {
                    echo "$cid causa " . $cidsInformadasSplit[$key + 1] . '<br>';
                    $causas += 1;
                    if ($primeiraSequencia == null) {
                        $primeiraSequencia = $cid;
                    }
                } else {
                    echo "$cid Não causa " . $cidsInformadasSplit[$key + 1] . '<br>';
                    $naoCausas += 1;
                }
            }
        }

        //Aplicar a regra do principio geral
        if ($naoCausas == 0) {
            $descricaoCausa = DB::table('tb_cid10')->where('CO_CATEG_SUBCATEG_SP', $cidsInformadasSplit[0])->first('NO_CATEGORIA_SUBCATEGORIA');
            echo 'A causa básica da morte é ' . $cidsInformadasSplit[0] . " ({$descricaoCausa->NO_CATEGORIA_SUBCATEGORIA})" . ' de acordo com a regra do princípio geral.<br>';
        }

        //Aplicar a regra RS1

        if ($naoCausas > 0 && $primeiraSequencia != null) {
            $descricaoCausa = DB::table('tb_cid10')->where('CO_CATEG_SUBCATEG_SP', $primeiraSequencia)->first('NO_CATEGORIA_SUBCATEGORIA');
            echo 'A causa básica da morte é ' . $primeiraSequencia . " ({$descricaoCausa->NO_CATEGORIA_SUBCATEGORIA})" . ' de acordo com a regra RS1.<br>';
        }

        //Aplicar a regra RS2
        if ($causas == 0) {
            $descricaoCausa = DB::table('tb_cid10')->where('CO_CATEG_SUBCATEG_SP', end($cidsInformadasSplit))->first('NO_CATEGORIA_SUBCATEGORIA');
            echo 'A causa básica da morte é ' . end($cidsInformadasSplit) . " ({$descricaoCausa->NO_CATEGORIA_SUBCATEGORIA})" . ' de acordo com a regra RS2.<br>';
        }
    }

    public function download_laudo($id)
    {
        $laudo = Laudo::find($id);
        $path = storage_path('app/public/' . $laudo->file_path);
        return response()->download($path, $laudo->file_name);
    }
}
