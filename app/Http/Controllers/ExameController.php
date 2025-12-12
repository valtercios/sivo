<?php

namespace App\Http\Controllers;

use App\Models\Corpo;
use App\Models\Exame;
use Illuminate\Support\Facades\DB;
use App\Models\ExameDocumento;
use App\Models\ExameStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ExameController extends Controller
{    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        DB::enableQueryLog();
        $this->middleware('permission:exames_view', ['only' => ['index', 'show']]);
        $this->middleware('permission:exames_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:exames_reply', ['only' => ['responderExame', 'anexarDocumentos', 'storeResposta']]);
    }    
    /**
     * index
     * Função para listar os exames e filtrar
     *
     * @param  mixed $request
     * @return void
     */
    public function index(Request $request)
    {
        $exames = Exame::select('exames.*')
            ->with(['corpo', 'status'])
            ->leftJoin('corpos', 'exames.corpo_id', '=', 'corpos.id')
            ->leftJoin('exames_status', 'exames.status_id', '=', 'exames_status.id');
        $status = ExameStatus::all();
        // Filtrar por nome do corpo
        if ($request->nomeCorpo) {
            $exames = $exames->whereHas('corpo', function ($q) use ($request) {
                $q->where('nome', 'like', '%' . strtoupper($request->nomeCorpo) . '%');
            });
        }
        if($request->dataInicial){
            $dataFinal = $request->dataFinal ? $request->dataFinal : Carbon::now();
            $exames = $exames->whereBetween('exames.created_at', [$request->dataInicial, $dataFinal]);
        }
        if($request->filtroStatus){
            $exames = $exames->where('exames.status_id', $request->filtroStatus);
        }
        if($request->solicitadosPorMim && $request->solicitadosPorMim == "on"){
            $exames = $exames->where('exames.solicitado_por', auth()->user()->id);
        }

        $sort = $request->get('sort', 'exames.created_at');
        $direction = $request->get('direction', 'desc');

        $sortMapping = [
            'id' => 'exames.id',
            'tipo_exame' => 'exames.tipo_exame',
            'corpo_nome' => 'corpos.nome',
            'status' => 'exames_status.descricao',
            'created_at' => 'exames.created_at',
        ];

        if (array_key_exists($sort, $sortMapping)) {
            $sortColumn = $sortMapping[$sort];
        } else {
            $sortColumn = 'exames.created_at';
        }

        $exames = $exames->orderBy($sortColumn, $direction)->paginate(10);
        return view('exames.index', compact('exames', 'status'));
    }    
    /**
     * create
     * Função para mostrar o formulário de criação de um exame
     *
     * @return void
     */
    public function create()
    {
        $corpos = Corpo::all();
        return view('exames.create', compact('corpos'));
    }    
    /**
     * store
     * Função para armazenar os dados de um exame
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'tipo_exame' => 'required',
            'corpo_id' => 'required',
        ]);

        $exame = Exame::create($request->except('_token', '_method'));

        if ($exame) {
            return redirect()->route('exames.index')->with('success', 'Exame solicitado com sucesso!');
        }
    }    
    /**
     * show
     * Função para mostrar os detalhes de um exame
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        $exame = Exame::find($id);
        $documentos = ExameDocumento::where('exame_id', $exame->id)->get();
        return view('exames.show', compact('exame', 'documentos'));
    }    
    /**
     * responderExame
     * Função para mostrar o formulário de resposta de um exame
     *
     * @param  mixed $id
     * @return void
     */
    public function responderExame($id)
    {
        $exame = Exame::find($id);
        return view('exames.responder-exame', compact('exame'));
    }    
    /**
     * anexarDocumentos
     * Função para anexar um documento na resposta de um exame
     *
     * @param  mixed $request
     * @return void
     */
    public function anexarDocumentos(Request $request)
    {
        $path = storage_path('app/tmp/uploads');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');

        $name = uniqid() . '_' . trim($file->getClientOriginalName());

        $file->move($path, $name);

        return response()->json([
            'name' => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }    
    /**
     * storeResposta
     * Função para salvar a resposta de um exame
     *
     * @param  mixed $request
     * @return void
     */
    public function storeResposta(Request $request)
    {
        $anexoDocumento = $request->document;
        // Mover arquivos
        if (!empty($anexoDocumento)){

            foreach ($request->document as $key => $value) {
                $format = explode('.', $value);
                $format = end($format);
                $nameWithoutUid = explode('_',$value)[1];
                Storage::move('/tmp/uploads/' . $value, 'public/exames/docs/' . $value);
                $dados = [
                    'exame_id' => $request->exame_id,
                    'name' => $nameWithoutUid,
                    'format' => $format,
                    'path' => 'exames/docs/' . $value,
                    'enviado_por' => auth()->user()->id,
                ];
                $documento = ExameDocumento::create($dados);
            }
        }

        $exame = Exame::find($request->exame_id);

        $exame->resposta = $request->resposta_exame;
        $exame->status_id = 2;
        $exame->respondido_por = auth()->user()->id;

        if ($exame->save()) {
            return redirect()->route('exames.index')->with('success', 'Exame respondido com sucesso!');
        }

    }
}
