<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Corpo;
use App\Models\OrgaoEmissor;
use App\Models\Funeraria;
use Barryvdh\DomPDF\Facade\Pdf;

class RecepcaoPDFController extends Controller
{

    /**
     * gerarDocumentoRecebimentoDeCorpo
     * Função para gerar o PDF do documento de Recebimento do Corpo com o DOMPDF
     *
     * @param  mixed $id
     * @return void
     */
    public function gerarDocumentoRecebimentoDeCorpo($id)
    {
        $corpo = Corpo::findOrFail($id);
        $pdf = PDF::loadView('documentos.recepcao.recebimento-de-corpo.template.template', compact('corpo'));
        return $pdf->stream('recebimentoCorpo.pdf');
    }
    /**
     * gerarDeclaracaoRetiradaDoCorpo
     * Função para gerar o PDF do documento de Declaração de retirada do corpo com o DOMPDF
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function gerarDeclaracaoRetiradaDoCorpo(Request $request, $id)
    {
        $dados = $request->all();
        $orgao = OrgaoEmissor::find($request->orgao_emissor_responsavel);
        $dados['orgao_emissor_responsavel'] = $orgao->sigla ?? null;
        $corpo = Corpo::findOrFail($id);
        $pdf = PDF::loadView('documentos.recepcao.declaracao-retirada-corpo-e-declaracao-obito.template.template', compact('corpo', 'dados'));
        return $pdf->stream('declaracao-retirada-corpo-e-declaracao-obito.pdf');
    }

    /**
     * gerarEncaminhamentoIML
     * Função para gerar o PDF do documento de Encaminhamento para o IML com o DOMPDF
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function gerarEncaminhamentoIML(Request $request, $id)
    {
        $dados = $request->all();
        $orgao = OrgaoEmissor::find($request->orgao_emissor_responsavel);
        $dados['orgao_emissor_responsavel'] = $orgao->sigla ?? null;
        //verificar se funeraia foi informada
        if ($request->funeraria != null) {
            $funeraria = Funeraria::find($request->funeraria);
            $dados['funeraria'] = $funeraria->nome;
        } else {
            $dados['funeraria'] = 'Não informado';
        }
        $corpo = Corpo::find($request->corpo_id);
        $pdf = PDF::loadView('documentos.recepcao.encaminhamento-iml.template.template', compact('dados', 'corpo'));
        return $pdf->stream('termo-de-autorizacao-para-retirada-do-corpo-e-encaminhamento-para-o-iml.pdf');
    }

    public function gerarTermoResponsabilidade(Request $request, $id)
    {
        $dados = $request->all();
        $orgao = OrgaoEmissor::find($request->orgao_emissor_responsavel);
        $dados['orgao_emissor_responsavel'] = $orgao->sigla ?? null;
        $corpo = Corpo::findOrFail($id);
        $pdf = PDF::loadView('documentos.recepcao.termo-responsabilidade-retidada-corpo-sem-exame.template.template', compact('corpo', 'dados'));
        return $pdf->stream('termo-responsabilidade-retidada-corpo-sem-exame.pdf');
    }

    /**
     * gerarHistoricoAcoes
     * Função para gerar o PDF do histórico de ações do corpo com o DOMPDF
     *
     * @param  mixed $id
     * @return void
     */
    public function gerarHistoricoAcoes($id)
    {
        $corpo = Corpo::findOrFail($id);
        
        // Buscar os audits/históricos do corpo
        $historico = \App\Models\HistoricoCorpo::where('corpo_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        $pdf = PDF::loadView('documentos.recepcao.historico-acoes.template.template', compact('corpo', 'historico'));
        return $pdf->stream('historico-acoes-corpo.pdf');
    }

    /**
     * gerarHistoricoAlteracoes
     * Função para gerar o PDF do histórico de alterações do corpo com o DOMPDF
     *
     * @param  mixed $id
     * @return void
     */
    public function gerarHistoricoAlteracoes($id)
    {
        $corpo = Corpo::findOrFail($id);
        
        // Buscar as justificativas/alterações do corpo
        $justificativa = \App\Models\Justificativa::where('corpo_id', $id)
            ->orderBy('updated_at', 'desc')
            ->get();

        // Buscar nomes dos usuários
        $nome = [];
        foreach ($justificativa as $item) {
            if ($item->user_id && !isset($nome[$item->user_id])) {
                $user = \App\Models\User::find($item->user_id);
                $nome[$item->user_id] = $user ? $user->name : 'Usuário desconhecido';
            }
        }

        $pdf = PDF::loadView('documentos.recepcao.historico-alteracoes.template.template', compact('corpo', 'justificativa', 'nome'));
        return $pdf->stream('historico-alteracoes-corpo.pdf');
    }
}
