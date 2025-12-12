<?php

namespace App\Http\Controllers;

use App\Models\UsuariosTipos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuariosTiposController extends Controller
{
    public function __construct()
    {   
        //log
        DB::enableQueryLog();

        // //permissões
        $this->middleware('permission:usuarios_view', ['only' => ['index','show']]);
        $this->middleware('permission:usuarios_create', ['only' => ['create','store']]);
        $this->middleware('permission:usuarios_delete', ['only' => ['destroy']]);
        $this->middleware('permission:usuarios_edit', ['only' => ['edit','update']]);
    }

    //retorna pra view todos os tipos de usuario
    public function index()
    {
        
        $tipos = UsuariosTipos::all();

        return view('usuarios.tipos.index', compact('tipos'));
    }

    // salva um novo tipo de usuarios
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $input = $request->all();
        $tiposUser = UsuariosTipos::create($input);

        if ($tiposUser) {
            return redirect()->route('usuarios.tipos.index')->with('success', 'Tipo de Usuário cadastrado com sucesso!');
        } else {
            return redirect()->back('usuarios.tipos.index')->with('error', 'Não foi possível Cadastrar');
        }
    }

    //atualiza um tipo de usuario especifico
    public function update(Request $request)
    {
        $tiposUser = UsuariosTipos::findOrFail($request->id);
        $tiposUser->name = $request->name;
        $tiposUser->update();
        if ($tiposUser) {
            return redirect()->route('usuarios.tipos.index')->with('success', 'Tipo de Usuário atualizada com sucesso!');
        } else {
            return redirect()->route('usuarios.tipos.index')->with('error', 'Não foi possível atualizar!');
        }
    }

    //exclui um tipo de usuario
    public function destroy($id)
    {

        $tiposUser = UsuariosTipos::findOrFail($id);
        $result = $tiposUser->delete();

        if ($result) {
            return redirect()->route('usuarios.tipos.index')->with('info', 'Tipo de usuário deletado com sucesso');
        } else {
            return redirect()->back('usuarios.tipos.index')->with('error', 'Não foi possível deletar');
        }
    }
}
