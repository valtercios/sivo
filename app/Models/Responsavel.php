<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Facades\DB;
use App\Helpers\UtilsHelpers;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditingAuditable;

class Responsavel extends Model implements Auditable
{
    use HasFactory;
    use AuditingAuditable;

    protected $fillable = [
        'nome',
        'rg',
        'orgao_emissor',
        'estado_rg',
        'cpf',
        'parente',
        'grau_parentesco',
        'outro_parentesco',
        'telefone',
        'sexo',
        'endereco_id',
        'numero_documento',
        'tipo_documento',
        'nacionalidade',
        'corpo_id',
    ]; 
    protected $guarded = ['id', 'created_at', 'update_at', 'deleted_at'];
    protected $table = 'responsaveis';

    public function generateTags(): array
    {
        return [
            UtilsHelpers::sqlWithBindings(DB::getQueryLog())
        ];
    }

    public function orgaoEmissor(){
        return $this->hasOne(OrgaoEmissor::class, 'id', 'orgao_emissor');
    }
    public function endereco(){
        return $this->hasOne(Endereco::class, 'id', 'endereco_id');
    }
    public function corpo(){
        if($this->grau_parentesco) {
            return $this->hasOne(Corpo::class, 'responsavel_corpo_id', 'id');
        }else{
            return $this->hasOne(Corpo::class, 'responsavel_entrega_id', 'id');
        }
    }
}
