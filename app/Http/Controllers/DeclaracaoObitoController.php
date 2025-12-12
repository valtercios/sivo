<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeclaracaoObitoController extends Controller
{    
    /**
     * index
     *
     * @param  mixed $id
     * @return void
     */
    public function index($id = null){
        return view('declaracao-obito.index');
    }
}
