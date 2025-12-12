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
}
