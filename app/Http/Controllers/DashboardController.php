<?php

namespace App\Http\Controllers;


use App\Models\Hospitais;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Corpo;
use App\Models\Funeraria;
use App\Models\Responsavel;
use App\Models\Entrevista;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use App\Notifications\SystemNotification;
use Illuminate\Support\Facades\Notification;
// import auth
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
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
        $this->middleware('auth');
    }
    /**
     * Lista todos os dados.
     *
     */
    public function index()
    {
        $contagemCorpos = Corpo::count();
        $contagemFunerarias = Funeraria::count();
        $contagemUsuarios = User::count();
        $contagemResponsaveis = Responsavel::pluck('cpf')->unique()->count();

        $obitos = Corpo::with('enderecoCorpo')->get();

        $obitosPorMunicipio = $obitos->groupBy(fn($obito) => strtolower(str_replace(' ', '', tirarAcentos($obito->enderecoCorpo->cidade))));
        $obitosPorBairro = $obitos->groupBy(fn($obito) => strtolower(str_replace(' ', '', tirarAcentos($obito->enderecoCorpo->bairro))));

        $obitosMunicipio = $obitosPorMunicipio->map(fn($obitosGrupo) => [
            'nome' => $obitosGrupo->first()->enderecoCorpo->cidade,
            'obitos' => $obitosGrupo->count(),
        ])->sortByDesc('obitos')->values()->toArray();

        $obitosBairro = $obitosPorBairro->map(fn($obitosGrupo) => [
            'nome' => $obitosGrupo->first()->enderecoCorpo->bairro,
            'obitos' => $obitosGrupo->count(),
        ])->sortByDesc('obitos')->values()->toArray();

        return view('dashboard.index', compact('obitosBairro', 'obitosMunicipio', 'contagemCorpos', 'contagemFunerarias', 'contagemUsuarios', 'contagemResponsaveis'));
    }
}
