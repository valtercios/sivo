<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissoesController extends Controller
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
        $this->middleware('permission:permissoes_view', ['only' => ['index','show']]);
        $this->middleware('permission:permissoes_create', ['only' => ['create','store']]);
        $this->middleware('permission:permissoes_delete', ['only' => ['destroy']]);
        $this->middleware('permission:permissoes_edit', ['only' => ['edit','update']]);
    }
        
    /**
     * index
     * Função para listar as permissões do sistema
     *
     * @return void
     */
    public function index()
    {
        $permissoes = Permission::all();
        
        return view('usuarios.permissoes.index', compact('permissoes'));
    }   
}
