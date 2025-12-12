<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
//import DB
use Illuminate\Support\Facades\Hash;
use App\Models\Corpo;
use Carbon\Carbon;

class ApiController extends Controller
{    
    /**
     * verificarIdentidade
     * Função para verificar a identidade do usuário e retornar se ele se autenticou com sucesso
     *
     * @param  mixed $request
     * @return void
     */
    public function verificarIdentidade(Request $request)
    {
        $usuarioLogado = Auth::user();
        $cpfFormatado = str_replace('.', '', $request->cpf);
        $cpfFormatado = str_replace('-', '', $cpfFormatado);
        if (empty($cpfFormatado) || empty($request->senha)) {
            return response()->json([
                'message' => 'É necessário informar todos os campos.',
                'code' => 1,
            ]);
        }
        if ($usuarioLogado->cpf != $cpfFormatado) {
            return response()->json([
                'message' => 'CPF do usuário inválido!',
                'code' => 1,
            ]);
        }
        if (!Hash::check($request->senha, Auth::user()->password)) {
            return response()->json([
                'message' => 'A senha está errada!',
                'code' => 1,
            ]);
        }

        return response()->json([
            'message' => 'Usuário logado!',
            'code' => 0,
        ]);

    }

    
    /**
     * buscarOcupacao
     * Função que retorna as ocupações com base em uma busca
     *
     * @param  mixed $term
     * @return void
     */
    public function buscarOcupacao($term = ""){
        if($term == ""){
            $ocupacoes = DB::table('tb_ocupacao_sinonimos')->where('ds_ocupacao', 'like', '%' . $term . '%')->orWhere('co_cbo', $term)->limit(10)->get();
        }else{
            $ocupacoes = DB::table('tb_ocupacao_sinonimos')->where('ds_ocupacao', 'like', '%' . $term . '%')->orWhere('co_cbo', $term)->get();
        }
        return response()->json($ocupacoes);
    }
    
    /**
     * pesquisarCID10
     * Função para realizar uma pesquisa na CID10
     *
     * @param  mixed $pesquisa
     * @return void
     */
    public function pesquisarCID10($pesquisa = null)
    {
        if (!$pesquisa) {
            return response()->json([
                'message' => 'É necessário informar todos os campos.',
                'code' => 1,
            ]);
        }
        $cid10 = DB::table('tb_cid10')->where('CO_CATEGORIA_SUBCATEGORIA', 'like', '%' . $pesquisa . '%')->orWhere('NO_CATEGORIA_SUBCATEGORIA', 'like', '%' . $pesquisa . '%')->get();
        return response()->json($cid10);
    }
    
    /**
     * getDashboardFiltrado
     * Função para filtrar os dados do dashboard
     *
     * @param  mixed $request
     * @return void
     */
    public function getDashboardFiltrado(Request $request){
        $obitos = Corpo::with('enderecoCorpo');
        if ($request->data_recebimento) {
            $dataSemEspacos = str_replace(' ', '', $request->data_recebimento);
            $data = explode('-', $dataSemEspacos);
            $dataInicio = Carbon::createFromFormat('d/m/Y', $data[0]);
            $dataFim = Carbon::createFromFormat('d/m/Y', $data[1]);
            $obitos->whereBetween('data_entrada', [$dataInicio, $dataFim]);
        }
        $obitos = $obitos->get();
        $contagemCorpos = $obitos->count();

        $dados = [
            'contagem_corpos' => $contagemCorpos
        ];

        return response()->json($dados);
        
    }
}
