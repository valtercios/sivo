<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PerfilController extends Controller
{
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        DB::enableQueryLog();
    }
    
    /**
     * index
     * Função para mostrar o formulário do perfil do usuário
     *
     * @return void
     */
    public function index()
    {
        $id_user = auth()->user()->id;
        $perfil = User::findOrFail($id_user);

        return view('perfil.index', compact('perfil'));
    }

    
    /**
     * update
     * Função para atualizar as informações do usuário
     *
     * @param  mixed $request
     * @return void
     */
    public function update(Request $request)
    {
        $user_id = auth()->user()->id;

        $user = User::findOrFail($user_id);

        $input = $request->all();

        $input['editado_por'] = $user->id;

        $input['image'] = $user->image;

        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $name = $user->id . Str::kebab($user->username);
            $extension = $request->image->extension();
            $nameFile = "{$name}.{$extension}";
            $input['image'] = $nameFile;

            $upload = $request->file('image')->storeAs('public', $nameFile);

            if (!$upload) {
                return redirect()
                    ->back()
                    ->with('error', 'Falha ao fazer upload da imagem');
            }
        }

        $atualizar = $user->update($input);

        if ($atualizar) {
            return redirect()->route('perfil.index')->with('success', 'Você atualizou seu perfil!');
        } else {
            return redirect()->back('perfil.index')->with('error', 'Erro na Atualização');
        }
    }
    
    /**
     * alterarSenha
     * Função para mostrar a view de alteração de senha do usuário
     *
     * @return void
     */
    public function alterarSenha()
    {
        return view('perfil.alterarsenha');
    }
    
    /**
     * updatePassword
     * Função para atualizar a senha do usuário
     *
     * @param  mixed $request
     * @return void
     */
    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'senha_atual' => 'required',
            'novasenha' => 'required',
            'novasenha_confirmar' => 'required|same:novasenha',
        ]);

        if ($validator->fails()) {
            return redirect()->route('alterarsenha')->with('error', 'As senhas não conferem!');
        }

        if (!Hash::check($request->senha_atual, Auth::user()->password)) {
            return redirect()->route('alterarsenha')->with('error', 'A senha atual não confere!');
        }

        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($request->novasenha);
        $user->save();

        auth()->setUser($user);

        return redirect()->route('alterarsenha')
            ->with('success', 'Senha alterada com sucesso');

    }

}
