<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PapeisPermissoesController extends Controller
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
     * index
     * Lista todos os papéis do sisema
     *
     * @return void
     */
    public function index()
    {
        $permissoes = Permission::orderBy('id', 'ASC')->get();
        $roles = Role::whereNotIn('id', [1])->orderBy('id', 'ASC')->get();
        return view('usuarios.papeis_permissoes.index', compact('roles', 'permissoes'));
    }

    /**
     * store
     * Função para salvar um papél no sistema
     *
     * @param  mixed $request
     * @return void
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
     * edit
     * Função para editar o papél no sistema
     *
     * @param  mixed $id
     * @return void
     */
    public function edit($id)
    {
        $info = Role::findOrFail($id);
        $permissoes = $info->permissions->all();
        $permissoes_ids = [];
        $permissions = Permission::all();
        $secoes = [];

        foreach ($permissions->toArray() as $permissao) {
            $nome_perm = $permissao["name"];
            $separador = "_";
            $secao = explode($separador, $nome_perm)[0];
            $nome_perm = explode($separador, $nome_perm)[1];

            if (!isset($secoes[$secao])) {
                $secoes[$secao] = ["name" => $secao, "permissoes" => []];
            }

            if (!in_array($nome_perm, array_column($secoes[$secao]["permissoes"], "name"))) {
                $secoes[$secao]["permissoes"][] = ["id" => $permissao['id'], "name" => $nome_perm, "descricao" => $permissao['descricao']];
            }
        }

        foreach ($permissoes as $key) {
            $permissoes_ids[] = $key->id;
        }

        return view('usuarios.papeis_permissoes.edit', compact('info', 'permissoes_ids', 'permissions', 'secoes'));
    }
    
    /**
     * update
     * Função para atualizar um papel no sistema
     *
     * @param  mixed $request
     * @return void
     */
    public function update(Request $request)
    {

        $input = $request->all();

        $verificarRole = Role::where('name', $input['name'])->first();
        $role = Role::find($input['id']);
        if ($verificarRole && $verificarRole->name != $role->name) {
            return redirect()->back()
                ->with('error', 'Já existe um papel com esse nome.');
        }

        $role->name = $input['name'];
        $role->save();
        $role->syncPermissions($request->permissions);

        return redirect()->route('papeisPermissoes.index')->with('success', 'Papel atualizado com sucesso');
    }

    /**
     * destroy
     * Função para deletar um papel
     *
     * @param  mixed $request
     * @return void
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
