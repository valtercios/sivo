<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Corpo;
use App\Models\Documento;
use App\Models\OrgaoEmissor;
use App\Models\Funeraria;
use Exception;

class DocumentosRecepcaoController extends Controller
{
        
    /**
     * index
     *
     * @return void
     */
    public function index(){
        $corpos = Corpo::get();
        return view('documentos.recepcao.index', compact('corpos'));
    }    
    /**
     * list
     *
     * @param  mixed $id
     * @return void
     */
    public function list($id){
        $corpo = Corpo::findOrFail($id);
        return view('documentos.recepcao.list', compact('corpo'));
    }    

    public function declaracaoRetiradaCorpoInfoAdicional($id) {
        $corpo = Corpo::find($id);
        $orgaos_emissores = OrgaoEmissor::all();
        return view('documentos.recepcao.declaracao-retirada-corpo-e-declaracao-obito.info-adicional', compact('corpo', 'orgaos_emissores'));
    }

    public function encaminhamentoIMLInfoAdicional($id){
        $corpo = Corpo::find($id);
        $orgaos_emissores = OrgaoEmissor::all();
        $funerarias = Funeraria::all();
        return view('documentos.recepcao.encaminhamento-iml.info-adicional', compact('corpo', 'orgaos_emissores', 'funerarias'));
    }
        /**
     * encaminhamentoInfoAdicional
     * Função que mostra o formulário de informações adicionais do encaminhamento genérico
     *
     * @param  mixed $id
     * @return void
     */
    public function encaminhamentoInfoAdicional($id){
        $corpo = Corpo::findOrFail($id);
        return view('documentos.recepcao.encaminhamento.info-adicional', compact('corpo'));
    }

    public function termoResponsabilidadeInfoAdicional($id){
        $corpo = Corpo::findOrFail($id);
        return view('documentos.recepcao.termo-responsabilidade-retidada-corpo-sem-exame.info-adicional', compact('corpo'));
    }

    /**
     * upload
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function upload(Request $request, $id){
        try {
            $contagemDocumentosEnviados = Documento::where('tipo_documento', $request->tipo_documento)->where('papel_documento', $request->papel_documento)->where('corpo_id', $request->corpo_id)->count();
            if($contagemDocumentosEnviados > 4){
                return redirect()->back()->with('error', 'Você excedeu o limite de documentos para este tipo de documento');
            }
            $upload = $request->arquivo->store('docs', 'public');
            if ($request->hasFile('arquivo') && $request->file('arquivo')->isValid()) {
                $originalname = $request->file('arquivo')->getClientOriginalName();
                if (!$upload) {
                    return redirect()->back()->with('error', 'Falha ao fazer upload de arquivo');
                }
            }
            $documento = new Documento();
            $documento->name = $originalname;
            $documento->format = $request->file('arquivo')->extension() ? $request->file('arquivo')->extension() : $request->file('arquivo')->getClientOriginalExtension();
            $documento->path = $upload;
            $documento->enviado_por = auth()->user()->id;
            $documento->tipo_documento = $request->tipo_documento;
            $documento->papel_documento = $request->papel_documento;
            $documento->corpo_id = $request->corpo_id;
            $documento->save();
            return redirect()->back()->with('success', 'Documento enviado com sucesso');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Falha ao enviar documento');
        }

    }
    
    
}
