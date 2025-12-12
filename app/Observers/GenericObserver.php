<?php

namespace App\Observers;

use App\Models\Corpo;
use App\Models\Justificativa;
use Illuminate\Support\Facades\Auth;


class GenericObserver
{
    public function updated($model)
    {
        
        // Obtém as alterações feitas
        $alteracoes = [];
        foreach ($model->getChanges() as $key => $value) {
            $alteracoes[] = [
                'campo' => $key,
                'antigo' => $model->getOriginal($key),
                'novo' => $value,
            ];
        }
      
        // Remove alterações no campo 'updated_at'
        foreach ($alteracoes as $key => $item) {
            if (isset($item['campo']) && $item['campo'] === 'updated_at') {
                unset($alteracoes[$key]);
            }
        }

        if (empty($alteracoes)) {
            return;
        }

        // Obtém a justificativa enviada pela requisição (ou define uma padrão)
        $justificativaTexto = request()->input('justificativa', 'Alteração realizada pelo sistema');

        // Salva no banco de dados
        Justificativa::create([
            'tabela' => $model->getTable(),
            'registro_id' => $model->id,
            'corpo_id' => $model instanceof Corpo ? $model->id : ($model->corpo_id ?? $model->id),
            'justificativa' => $justificativaTexto,
            'alteracoes' => json_encode($alteracoes, JSON_UNESCAPED_UNICODE), // Melhor leitura
            'user_id' => Auth::id(), // Evita erro se o usuário não estiver autenticado
        ]);
    }
}
