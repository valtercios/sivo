<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuariosRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UsuariosTipos;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;
use App\Helpers\UtilsHelpers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\URL;

class UsuariosController extends Controller
{
    public function __construct()
    {
        DB::enableQueryLog();
        //permissões
        $this->middleware('permission:usuarios_view', ['only' => ['index', 'show']]);
        $this->middleware('permission:usuarios_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:usuarios_delete', ['only' => ['destroy']]);
        $this->middleware('permission:usuarios_edit', ['only' => ['edit', 'update']]);
    }

    
    /**
     * index
     * Função para listar todos os usuários do sistema
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        // Pegar todos os usuários menos os com a role de Administrador
        $papel = Auth::user()->roles->pluck('name')->first();

        if ($papel == "Administrador") {
            $data = User::orderBy('id', 'DESC')->get();
        } else {
            $data = User::whereHas('roles', function ($role) {
                    $role->where('name', '!=', 'Administrador');
                })
                ->orderBy('id', 'DESC')
                ->get();
        }

        return view('usuarios.index', compact('data'));
    }
    
    /**
     * create
     * Função para mostrar o formulário de criação de usuário
     *
     * @return void
     */
    public function create()
    {
        $papel = Auth::user()->roles->pluck('name')[0];
        $roles = Role::whereNotIn('name', ['Administrador'])->get();
        if($papel == 'Administrador'){
            $roles = Role::all();
        }
        $tipos = UsuariosTipos::all();
        return view('usuarios.create', compact('roles', 'tipos'));
    }

    
    /**
     * store
     * Função para criar um usuário no sistema
     *
     * @param  mixed $request
     * @return void
     */
    public function store(UsuariosRequest $request)
    {
        $input = $request->all();
        $cpfApenasNumeros = preg_replace('/[^0-9]/', '', $input['cpf']);
        $verificarCPFValido = UtilsHelpers::validaCPF($cpfApenasNumeros);
        if(!$verificarCPFValido){
            return back()->with('error', 'O CPF informado não é valido!');
        }
        $buscarCPF = User::where('cpf', $cpfApenasNumeros)->first();
        if($buscarCPF){
            return back()->with('error', 'Já existe um usuário cadastro com esse CPF');
        }
        $input['password'] = Hash::make($input['password']);
        $input['cadastrado_por'] = auth()->user()->id;
        $input['cpf'] = $cpfApenasNumeros;
        $user = User::create($input);
        $user->assignRole($request->input('roles'));


        return redirect()->route('usuarios.index')
            ->with('success', 'Usuário criado com sucesso');
    }

    
    /**
     * show
     * Função para mostrar os detalhes de um usuário
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('usuarios.show', compact('user'));
    }

      
    /**
     * edit
     * Função para mostrar o formulário de edição de um usuário
     *
     * @param  mixed $id
     * @param  mixed $request
     * @return void
     */
    public function edit($id, Request $request)
    {
        $info = User::find($id);
        $papel = Auth::user()->roles->pluck('name')[0];
        $roles = Role::whereNotIn('name', ['Administrador'])->get();
        if($papel == 'Administrador'){
            $roles = Role::all();
        }
        $userRole = $info->roles->all();
        $roles_ids = [];
        $tipos = UsuariosTipos::all();

        foreach ($userRole as $key) {
            $roles_ids[] = $key->id;
        }
        return view('usuarios.edit', compact('info', 'roles', 'roles_ids', 'tipos'));
    }
    
    /**
     * update
     * Função para atualizar um usuário
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'roles' => 'required'
        ]);

        $user = User::find($id);

        $input = $request->except('cpf');

        if(!$user->cpf){
            $input = $request->all();
        }

        if(!isset($input['crm'])){
            $input['crm'] = null;
        }

        $input['editado_por'] = auth()->user()->id;
        
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuário atualizado com sucesso');
    }

    
    /**
     * destroy
     * Função para atualizar um usuário
     *
     * @param  mixed $request
     * @return void
     */
    public function destroy(Request $request)
    {

        User::find($request->id)->delete();
        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario Desativado com Sucesso');
    }

    
    /**
     * desativados
     * Função para mostrar os usuários desativados
     *
     * @return void
     */
    public function desativados()
    {
        $desativados = User::onlyTrashed()->get();

        return view('usuarios.desativados', compact('desativados'));
    }

    
    /**
     * ativar
     * Função para ativar um usuário
     *
     * @param  mixed $request
     * @return void
     */
    public function ativar(Request $request)
    {
        $ativar = User::withTrashed()->find($request->id)->restore();

        if ($ativar) {
            return redirect()->route('usuarios.index')
                ->with('success', 'Usuario reativado com Sucesso');
        } else {
            return redirect()->back('usuarios.index')
                ->with('error', 'erro ao reativar!');
        }
    }
    
    /**
     * resetarSenha
     * Função para resetar a senha de um usuário
     *
     * @param  mixed $request
     * @return void
     */
    public function resetarSenha(Request $request){
        $user = User::find($request->id);
        $user->password = Hash::make('12345678');
        $user->atualizacao = 0;
        $user->save();

        return redirect()->route('usuarios.index')
            ->with('success', 'Senha resetada com sucesso');
    }
    
    /**
     * primeiroAcesso
     * Função para mostrar a view do primeiro acesso
     *
     * @return void
     */
    public function primeiroAcesso(){
        return view('usuarios.atualizarsenha');
    }
    
    /**
     * atualizarSenha
     * Função para atualizar a senha após o primeiro acesso
     *
     * @param  mixed $request
     * @return void
     */
    public function atualizarSenha(Request $request){
        $validator = Validator::make($request->all(), [
            'senha_atual' => 'required',
            'novasenha' => 'required',
            'novasenha_confirmar' => 'required|same:novasenha',
        ]);

        if ($validator->fails()) {
            return redirect()->route('usuarios.primeiroacesso')->with('error', 'As senhas não conferem!');
        }

        if (!Hash::check($request->senha_atual, Auth::user()->password)) {
            return redirect()->route('usuarios.primeiroacesso')->with('error', 'A senha atual não confere!');
        }

        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($request->novasenha);
        $user->atualizacao = 1;
        $user->save();

        auth()->setUser($user);

        return redirect()->route('dashboard.index')
            ->with('success', 'Senha atualizada com sucesso!');
    }
    
}
