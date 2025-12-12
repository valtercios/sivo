<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class PapeisController extends Controller
{
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        DB::enableQueryLog();
        $this->middleware('permission:papeis_view', ['only' => ['index', 'show']]);
        $this->middleware('permission:papeis_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:papeis_delete', ['only' => ['destroy']]);
        $this->middleware('permission:papeis_edit', ['only' => ['edit', 'update']]);
    }
    /**
     * Lista todos os dados.
     *
     */
    public function index()
    {
        $roles = Role::whereNotIn('id', [1])->get();
        return view('usuarios.papeis.index', compact('roles'));
    }

    /**
     * salva um novo item
     */
    public function store(Request $request)
    {

        try {
            $this->validate($request, [
                'name' => 'required',
            ]);

            $input['name'] = $request->name;
            $input['guard_name'] = 'web';

            $papeis = Role::create($input);
            
        } catch (\Spatie\Permission\Exceptions\RoleAlreadyExists $th) {
            return redirect()->back()->with('error', 'Já existe um papel com esse nome');
        }

        if ($papeis) {
            return redirect()->route('papeisPermissoes.index')->with('success', 'Papel cadastrado com sucesso!');
        } else {
            return redirect()->back('papeisPermissoes.index')->with('error', 'Não foi possível Cadastrar');
        }

        
    }

    /**
     * Chava uma view para edição de item
     */
    public function update(Request $request)
    {
        $papeis = Role::findOrFail($request->id);
        $papeis->name = $request->name;
        $papeis->update();
        if ($papeis) {
            return redirect()->route('papeisPermissoes.index')->with('success', 'papel de Usuário atualizada com sucesso!');
        } else {
            return redirect()->route('usuarios.tipos.index')->with('error', 'Não foi possível atualizar!');
        }
    }

    /**
     * Deleta um item
     */
    public function destroy(Request $request)
    {
        $papeis = Role::findOrFail($request->id);
        $papeis->delete();
        if ($papeis) {
            return redirect()->route('papeisPermissoes.index')->with('success', 'Papel de Usuário deletado com sucesso!');
        } else {
            return redirect()->route('papeisPermissoes.index')->with('error', 'Não foi possível deletar!');
        }
    }

}
