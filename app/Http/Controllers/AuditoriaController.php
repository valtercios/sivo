<?php

namespace App\Http\Controllers;

use App\Models\Audits;
use App\Models\Hospitais;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuditoriaController extends Controller
{
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        DB::enableQueryLog();
        $this->middleware('permission:audits', ['only' => ['index','show']]);
    }
   
    /**
     * index
     * Função para listagem e filtro das auditorias
     *
     * @param  mixed $request
     * @return void
     */
    public function index(Request $request)
    {
        $usuarios = User::all();
        $logs = Audits::orderBy('created_at', 'desc');
        if($request->dataInicial){
            $dataFinal = $request->dataFinal ? $request->dataFinal : \Carbon\Carbon::now();
            $logs->whereBetween('created_at', [$request->dataInicial, $dataFinal])->orderBy('id', 'desc');
        }
        if($request->filtroUsuario){
            $logs->where('user_id', $request->filtroUsuario);
        }
        $logs = $logs->get();
        return view('auditoria.logs.index', compact('logs', 'usuarios'));
    }    
    /**
     * show
     * Função para mostrar os detalhes de uma auditoria
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        $log = Audits::findOrFail($id);
        return view('auditoria.logs.show', compact('log'));
    }

}
