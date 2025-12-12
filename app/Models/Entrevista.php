<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ocupacao;
use App\Models\Corpo;
use App\Models\Endereco;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Facades\DB;
use App\Helpers\UtilsHelpers;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditingAuditable;

class Entrevista extends Model implements Auditable
{
    use HasFactory;
    use AuditingAuditable;
    use SoftDeletes;
    protected $fillable = [
        'status_id',
        'corpo_id',
        'entrevistado_por',
        'estado_civil', 
        'cor', 
        'pai',
        'mae',
        'telefone',
        'naturalidade',
        'escolaridade_corpo',
        'escolaridade_corpo_serie',
        'documento_identificacao',
        'num_documento',
        'ocupacao_id',
        'aposentado',
        'data_nascimento_mae',
        'obito_fetal',
        'ocupacao_mae_id',
        'aposentado_mae',
        'escolaridade_mae',
        'tipo_de_parto',
        'morte_relacao_parto',
        'nm',
        'nv',
        'tempo_gestacao',
        'endereco_mae_id',
        'outros_beneficios',
        'digitador_id',
        'cod_cbo',
    ]; 
    protected $guarded = ['id', 'created_at', 'update_at', 'deleted_at'];
    protected $table = 'entrevistas';

    public function generateTags(): array
    {
        return [
            UtilsHelpers::sqlWithBindings(DB::getQueryLog())
        ];
    }
    public function status(){
        return $this->hasOne(EntrevistaStatus::class, 'id', 'status_id');
    }
    public function corpo(){
        return $this->hasOne(Corpo::class, 'id', 'corpo_id');
    }
    public function entrevistador(){
        return $this->hasOne(User::class, 'id', 'entrevistado_por');
    }
    public function ocupacao(){
        return $this->hasOne(Ocupacao::class, 'id', 'ocupacao_id');
    }
    public function ocupacaoMae(){
        return $this->hasOne(Ocupacao::class, 'id', 'ocupacao_mae_id');
    }
    public function enderecoMae(){
        return $this->hasOne(Endereco::class, 'id', 'endereco_mae_id');
    }

    public function getOcupacaoCorpoDescricaoAttribute() {
        
        if ($this->ocupacao_id) {
            $ocupacao = DB::table('tb_ocupacao')->where('id', $this->ocupacao_id)->first();
            if ($ocupacao) {
                return $ocupacao->ds_ocupacao . ' - ' . (($ocupacao->co_cbo) ? $ocupacao->co_cbo : 'CBO não informado');
            } else {
                $ocupacao = DB::table('tb_ocupacao_sinonimos')->where('id', $this->ocupacao_id)->first();
                return $ocupacao->ds_ocupacao . ' - ' .  (($ocupacao->co_cbo) ? $ocupacao->co_cbo : 'CBO não informado');
            }
            return "Ocupação não cadastrada";
        }

        if ($this->cod_cbo) {
            $codigoCBO =  str_replace('-', '', $this->cod_cbo);
            $ocupacao = DB::table('tb_ocupacao_sinonimos')->where('co_cbo', $codigoCBO)->first();
            if ($ocupacao) {
                return $ocupacao->ds_ocupacao . ' - ' . $ocupacao->co_cbo;
            }
            return "Ocupação não cadastrada";
        }
        
        return "Ocupação não informada";
    }
}
