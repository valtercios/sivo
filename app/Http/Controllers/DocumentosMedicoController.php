<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Corpo;

class DocumentosMedicoController extends Controller
{    
    /**
     * index
     *
     * @return void
     */
    public function index(){
        $corpos = Corpo::whereNotNull('entrevista_id')->get();
        return view('documentos.medico.index', compact('corpos'));
    }    
    /**
     * list
     *
     * @param  mixed $id
     * @return void
     */
    public function list($id){
        $corpo = Corpo::findOrFail($id);
        return view('documentos.medico.list', compact('corpo'));
    }
}
