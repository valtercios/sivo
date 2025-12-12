<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Responsavel;
use App\Models\Corpo;
use Illuminate\Support\Facades\DB;

class ResponsavelController extends Controller
{
    /**
     * Construct possui a chamada de log e as restrinções de permissões do usuario.
     *
     * @return void
     */
    public function __construct()
    {
        DB::enableQueryLog();
    }

    /**
     * Index possui a listagem de responsaveis.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $responsaveis = Responsavel::select('*')->with('orgaoEmissor');
        
        if($request->nome){
            $responsaveis->where('nome', 'like', '%' . strtoupper($request->nome) . '%');
        }

        if($request->filtroCorpo){
            $responsaveis->whereHas('corpo', function($query) use ($request){
                $query->where('corpos.id', $request->filtroCorpo);
            });
        }

        $sort = $request->get('sort', 'nome');
        $direction = $request->get('direction', 'asc');

        $allowedSorts = ['id', 'nome', 'cpf', 'rg'];
        if (!in_array($sort, $allowedSorts)) {
            $sort = 'id';
        }

        $responsaveis = $responsaveis->orderBy($sort, $direction)->paginate(10);
        $corpos = Corpo::orderBy('nome', 'asc')->get();
        return view('responsaveis.index', compact('responsaveis', 'corpos'));
    }

    /**
     * Show possui a função de mostrar os dados do banco de dados.
     *
     * @param  \App\Models\Responsavel  $responsavel
     * @return \Illuminate\Http\Response
     */

    public function show($id)

    {
        $responsavel = Responsavel::findOrFail($id);
        return view('responsaveis.show', compact('responsavel'));
    }
}
