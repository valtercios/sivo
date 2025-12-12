<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funeraria;
use App\Models\User;
use App\Models\Endereco;
use Illuminate\Support\Facades\DB;
use App\Notifications\SystemNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;

class FunerariaController extends Controller
{
    /**
     * Construct possui a chamada de log e as restrinções de permissões do usuario.
     *
     * @return void
     */
    public function __construct()
    {
        DB::enableQueryLog();
        $this->middleware('permission:funerarias_view', ['only' => ['index','show']]);
        $this->middleware('permission:funerarias_create', ['only' => ['create','store']]);
        $this->middleware('permission:funerarias_delete', ['only' => ['destroy']]);
        $this->middleware('permission:funerarias_edit', ['only' => ['edit','update']]);
    }

    /**
     * Index possui a listagem de funerarias.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $funerarias = Funeraria::with('enderecoFuneraria');
        $nome = $request->get('nome');
        if ($nome) { 
            $funerarias = $funerarias->where('nome', 'like', '%' . strtoupper($nome) . '%');
        }

        $sort = $request->get('sort', 'id');
        $direction = $request->get('direction', 'desc');

        $allowedSorts = ['id', 'nome', 'endereco'];
        if (!in_array($sort, $allowedSorts)) {
            $sort = 'id';
        }

        $funerarias = $funerarias->orderBy($sort, $direction)->paginate(10);
        return view('funerarias.index', compact('funerarias'));
    }

    /**
     * Create possui a view de cadastro de funerarias.
     *
     * @return \Illuminate\Contracts\View\View
     */

    public function create()
    {
        return view('funerarias.create');
    }

    /**
     * Store possui a função de salvar os dados no banco de dados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function store(Request $request)
    {
        $this->validate($request, [
            'nome' => 'required',
        ]);
        //Criar endereço
        $endereco = Endereco::create($request->except('_token', '_method', 'nome'));
        //Cria a funerária
        $funeraria = Funeraria::create([
            'nome' => $request->nome,
            'endereco' => $endereco->id
        ]);
        if(!$funeraria){
            return redirect()->back()->with('error', 'Erro ao cadastrar funeraria');
        }
        $users = User::all();
        Notification::send($users, new SystemNotification('success', 'Funerária cadastrada', 'Uma nova funerária foi cadastrada #' . $funeraria->id , 'Foi cadastrado uma nova funerária do id #' . $funeraria->id, Auth::user()->id));
        return redirect()->route('funerarias.index')->with('success', 'Funeraria cadastrada com sucesso!');

    }

    /**
     * Show possui a função de mostrar os dados de uma funeraria.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */

    public function show($id)
    {
        $funeraria = Funeraria::findOrFail($id);
        return view('funerarias.show', compact('funeraria'));
    }

    /**
     * Edit possui a função de mostrar a view de edição de uma funeraria.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */

    public function edit($id)
    {
        $funeraria = Funeraria::findOrFail($id);
        return view('funerarias.edit', compact('funeraria'));
    }

    /**
     * Update possui a função de atualizar os dados de uma funeraria.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function update(Request $request, $id)
    {
        $funeraria = Funeraria::findOrFail($id);
        $endereco = Endereco::findOrFail($funeraria->endereco);
        $endereco->update($request->except('_token', '_method', 'nome'));
        $funeraria->update([
            'nome' => $request->nome,
            'endereco' => $endereco->id
        ]);
        if(!$funeraria){
            return redirect()->back()->with('error', 'Erro ao atualizar funeraria');
        }
        return redirect()->route('funerarias.index')->with('success', 'Funeraria atualizada com sucesso!');
    }

    /**
     * Destroy possui a função de deletar uma funeraria.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function destroy(Request $request)
    {
        $funeraria = Funeraria::findOrFail($request->id);
        $endereco = Endereco::findOrFail($funeraria->endereco);
        $endereco->delete();
        $funeraria->delete();
        if(!$funeraria){
            return redirect()->back()->with('error', 'Erro ao deletar funeraria');
        }
        return redirect()->route('funerarias.index')->with('success', 'Funeraria deletada com sucesso!');
    }
    
    /**
     * createFunerariaAPI
     *
     * @param  mixed $request
     * @return void
     */
    public function createFunerariaAPI(Request $request){
        $verificarFuneraria = Funeraria::where('nome', $request->nomeFuneraria)->first();
        if($verificarFuneraria){
            return response()->json([
                'message' => 'Já existe uma funerária com esse nome.',
                'code' => 1
            ]);
        }
        //Criar endereço
        $endereco = Endereco::create([
            "cep" => $request->cepFuneraria,
            "logradouro" => $request->logradouroFuneraria,
            "numero" => $request->numeroFuneraria,
            "bairro" => $request->bairroFuneraria,
            "cidade" => $request->cidadeFuneraria,
            "estado" => $request->estadoFuneraria
        ]);
        //Cria a funerária
        $funeraria = Funeraria::create([
            'nome' => $request->nomeFuneraria,
            'endereco' => $endereco->id
        ]);
        if(!$funeraria){
            return response()->json([
                'message' => 'Erro ao cadastrar funerária',
                'code' => 1
            ]);
        }
        return response()->json([
            'message' => 'Funerária cadastrada com sucesso.',
            'id' => $funeraria->id,
            'code' => 0
        ]);
    }
    
    /**
     * getFunerariasAPI
     * Função que retorna as funerárias em um JSON
     *
     * @return void
     */
    public function getFunerariasAPI(){
        $funerarias = Funeraria::all('id', 'nome');
        return response()->json($funerarias);
    }
    
}
