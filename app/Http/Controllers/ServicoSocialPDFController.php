<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Corpo;
use App\Models\Ocupacao;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class ServicoSocialPDFController extends Controller
{
    
    /**
     * gerarDocumentoTCLE
     * Função para gerar o PDF do documento do TCLE com o DOMPDF
     *
     * @param  mixed $id
     * @param  mixed $medico
     * @return void
     */
    public function gerarDocumentoTCLE($id, $medico){
        $corpo = Corpo::findOrFail($id);
        $medico = User::find($medico);
        $pdf = PDF::loadView('documentos.servico-social.tcle.template.template' , compact('corpo', 'medico'));
        return $pdf->stream('tcle.pdf');
    }    
    /**
     * gerarLaudo
     * Função para gerar o PDF do documento do Laudo do Corpo com o DOMPDF
     *
     * @param  mixed $id
     * @return void
     */
    public function gerarLaudo($id){
        $corpo = Corpo::findOrFail($id);
        if($corpo->laudo == null){
            return back()->with('error', 'O corpo não possui laudo');
        }else{
            $pdf = PDF::loadView('documentos.servico-social.laudo.template.template' , compact('corpo'));
            return $pdf->stream('laudo.pdf');
        }
        
    }    
    /**
     * gerarTermoConsentimentoFamiliarAutopsiaVerbal
     * Função para gerar o PDF do documento de Termo de consentimento de familiar de autopsia verbal com o DOMPDF
     *
     * @param  mixed $id
     * @return void
     */
    public function gerarTermoConsentimentoFamiliarAutopsiaVerbal($id){
        $corpo = Corpo::findOrFail($id);
        $pdf = PDF::loadView('documentos.servico-social.termo-consentimento-familiar-autopsia-verbal.template.template' , compact('corpo'));
        return $pdf->stream('termo-consentimento-familiar-autopsia-verbal.pdf');
    }    
    /**
     * gerarTermoResponsabilidade
     * Função para gerar o PDF do documento de Termo de responsabilidade com o DOMPDF
     *
     * @param  mixed $id
     * @return void
     */
    public function gerarTermoResponsabilidade($id){
        $corpo = Corpo::findOrFail($id);
        $pdf = PDF::loadView('documentos.servico-social.termo-responsabilidade.template.template' , compact('corpo'));
        return $pdf->stream('termo-responsabilidade.pdf');
    }    
    /**
     * gerarDeclaracaoDeComparecimento
     * Função para gerar o PDF do documento de Declaração de comparecimento com o DOMPDF
     *
     * @param  mixed $id
     * @return void
     */
    public function gerarDeclaracaoDeComparecimento($id){
        $corpo = Corpo::findOrFail($id);
        $pdf = PDF::loadView('documentos.servico-social.declaracao-de-comparecimento.template.template' , compact('corpo'));
        return $pdf->stream('declaracaoComparecimento.pdf');
    }    
    /**
     * gerarDeclaracaoGrauDeParentesco
     * Função para gerar o PDF do documento de Declaração de grau de parentesco com o DOMPDF
     *
     * @param  mixed $request
     * @return void
     */
    public function gerarDeclaracaoGrauDeParentesco(Request $request){
        $testemunhas = $request->all();
        $corpo = Corpo::findOrFail($request->corpo_id);
        $pdf = PDF::loadView('documentos.servico-social.declaracao-grau-de-parentesco.template.template' , compact('corpo', 'testemunhas'));
        return $pdf->stream('declaracaoGrauDeParentesco.pdf');
    }    
    /**
     * gerarTermoNaoAutorizacaoAutopsia
     * Função para gerar o PDF do Termo de não autorização de autopsia com o DOMPDF
     *
     * @param  mixed $id
     * @return void
     */
    public function gerarTermoNaoAutorizacaoAutopsia($id){
        $corpo = Corpo::findOrFail($id);
        $pdf = PDF::loadView('documentos.servico-social.termo-nao-autorizacao-autopsia.template.template' , compact('corpo'));
        return $pdf->stream('termoNaoAutorizacaoAutopsia.pdf');
    }    
    /**
     * gerarDeclaracaoPosseCorpo
     * Função para gerar o PDF do documento de Declaração de posse de corpo com o DOMPDF
     *
     * @param  mixed $id
     * @return void
     */
    public function gerarDeclaracaoPosseCorpo($id){
        $corpo = Corpo::findOrFail($id);
        $pdf = PDF::loadView('documentos.servico-social.declaracao-posse-corpo.template.template' , compact('corpo'));
        return $pdf->stream('declaracaoPosseCorpo.pdf');
    }    
    /**
     * gerarEncaminhamentoDefensoria
     * Função para gerar o PDF do documento de Encaminhamento para a defensoria com o DOMPDF
     *
     * @param  mixed $request
     * @return void
     */
    public function gerarEncaminhamentoDefensoria(Request $request){
        $corpo = Corpo::findOrFail($request->corpo_id);
        $dados = $request->all();
        $pdf = PDF::loadView('documentos.servico-social.encaminhamento-a-defensoria.template.template' , compact('corpo', 'dados'));
        return $pdf->stream('encaminhamentoDefensoria.pdf');
    }    
    /**
     * gerarEncaminhamento
     * Função para gerar o PDF do documento de Encaminhamento genérico com o DOMPDF
     *
     * @param  mixed $request
     * @return void
     */
    public function gerarEncaminhamento(Request $request){
        $dados = $request->all();
        $corpo = Corpo::findOrFail($request->corpo_id);
        if($corpo->data_nascimento == null){
            $corpo->data_nascimento = $request->data_nascimento_corpo;
            $corpo->update();
        }else{
            $dados['data_nascimento_corpo'] = $corpo->data_nascimento;
        }
        $pdf = PDF::loadView('documentos.servico-social.encaminhamento.template.template' , compact('corpo', 'dados'));
        return $pdf->stream('encaminhamento.pdf');
    }    
    /**
     * gerarEncaminhamentoMaterialLacen
     * Função para gerar o PDF do documento de Encaminhamento para o LACEN com o DOMPDF
     *
     * @param  mixed $request
     * @return void
     */
    public function gerarEncaminhamentoMaterialLacen(Request $request){
        $dados = $request->all();
        $corpo = Corpo::findOrFail($request->corpo_id);
        $pdf = PDF::loadView('documentos.servico-social.encaminhamento-material-lacen.template.template' , compact('corpo', 'dados'));
        return $pdf->stream('encaminhamentoMaterialLacen.pdf');
    }    
    /**
     * gerarFichaInca
     * Função para gerar o PDF da ficha INCA com o DOMPDF
     *
     * @param  mixed $request
     * @return void
     */
    public function gerarFichaInca(Request $request){
        $dados = $request;
        $corpo = Corpo::find($request->corpo_id);
        $pdf = PDF::loadView('documentos.medico.ficha-inca.template.template' , compact('corpo', 'dados'));
        return $pdf->stream('fichaInca.pdf');
    }


        /**
     * gerarTermoReconhecimentoCadaver
     * Função para gerar o PDF da Termo Reconhecimento Cadaver com o DOMPDF
     *
     * @param  mixed $request
     * @return void
     */
    public function gerarTermoReconhecimentoCadaver($id){
        $corpo = Corpo::findOrFail($id);
        $ocupacoes = DB::table('tb_ocupacao_sinonimos')->get();
        $ocupacoes = DB::table('tb_ocupacao')->get();
        $ocupacaoCorpo = $ocupacoes->where('id',$corpo->entrevistaInfo->ocupacao_id ?? $corpo->entrevistaInfo->ocupacao_mae_id)->first();
        $pdf = PDF::loadView('documentos.medico.termo-reconhecimento-cadaver.template.template' , compact('corpo', 'ocupacaoCorpo'));
        return $pdf->stream('termoReconhecimentoCadaver.pdf');
    }
}
