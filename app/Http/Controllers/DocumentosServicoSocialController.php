<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Corpo;
use App\Models\User;

class DocumentosServicoSocialController extends Controller
{    
    /**
     * index
     *
     * @return void
     */
    public function index(){
        $corpos = Corpo::whereNotNull('entrevista_id')->get();
        return view('documentos.servico-social.index', compact('corpos'));
    }    
    /**
     * list
     *
     * @param  mixed $id
     * @return void
     */
    public function list($id){
        $corpo = Corpo::findOrFail($id);
        return view('documentos.servico-social.list', compact('corpo'));
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
        return view('documentos.servico-social.encaminhamento.info-adicional', compact('corpo'));
    }
        
    /**
     * encaminhamentoDefensoriaInfoAdicional
     * Função que mostra o formulário de informações adicionais do encaminhamento para a defensoria
     *
     * @param  mixed $id
     * @return void
     */
    public function encaminhamentoDefensoriaInfoAdicional($id){
        $corpo = Corpo::findOrFail($id);
        return view('documentos.servico-social.encaminhamento-a-defensoria.info-adicional', compact('corpo'));
    }
    /**
     * encaminhamentoLacenInfoAdicional
     * Função que mostra o formulário de informações adicionais do encaminhamento para o LACEN
     *
     * @param  mixed $id
     * @return void
     */
    public function encaminhamentoLacenInfoAdicional($id){
        $corpo = Corpo::findOrFail($id);
        return view('documentos.servico-social.encaminhamento-material-lacen.info-adicional', compact('corpo'));
    }    
    /**
     * declaracaoGrauParentescoInfoAdicional
     * Função que mostra o formulário de informações adicionais da declaração de grau de parentesco
     *
     * @param  mixed $id
     * @return void
     */
    public function declaracaoGrauParentescoInfoAdicional($id){
        $corpo = Corpo::findOrFail($id);
        return view('documentos.servico-social.declaracao-grau-de-parentesco.info-adicional', compact('corpo'));
    }    
    
    
    /**
     * tcleInfoAdicional
     * Função que mostra o formulário de informações adicionais para o TCLE
     *
     * @param  mixed $id
     * @return void
     */
    public function tcleInfoAdicional($id){
        $medicos = User::role('Médico')->get()->toArray();

        $corpo_id = $id;
        return view('documentos.servico-social.tcle.info-adicional', compact('medicos', 'corpo_id'));
    }
    
    /**
     * fichaIncaInfoAdicional
     * Função que mostra o formulário de informações adicionais para a ficha INCA
     *
     * @param  mixed $id
     * @return void
     */
    public function fichaIncaInfoAdicional($id){
        $corpo = Corpo::findOrFail($id);
        return view('documentos.medico.ficha-inca.info-adicional', compact('corpo'));
    }
}
