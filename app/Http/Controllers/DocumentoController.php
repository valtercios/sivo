<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Documento;
//import storage
use Illuminate\Support\Facades\Storage;

class DocumentoController extends Controller
{    
    /**
     * listarDocumentos
     *
     * @param  mixed $papel
     * @param  mixed $tipo
     * @param  mixed $corpoid
     * @return void
     */
    public function listarDocumentos($papel = null, $tipo = null, $corpoid = null){
        $documentos = Documento::where('papel_documento', $papel)->where('tipo_documento', $tipo)->where('corpo_id', $corpoid)->get();
        return response()->json($documentos);
    }    
    /**
     * deletarArquivo
     *
     * @param  mixed $id
     * @return void
     */
    public function deletarArquivo($id){
        $documento = Documento::findOrFail($id);
        Storage::disk('public')->delete($documento->path);
        $documento->delete();
        //delete file from storage
        return redirect()->back()->with('success', 'Documento deletado com sucesso');
    }
}
