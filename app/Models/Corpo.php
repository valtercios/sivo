<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Facades\DB;
use App\Helpers\UtilsHelpers;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditingAuditable;


class Corpo extends Model implements Auditable
{
    use HasFactory;
    use AuditingAuditable;
    use SoftDeletes;
    public function generateTags(): array
    {
        return [
            UtilsHelpers::sqlWithBindings(DB::getQueryLog())
        ];
    }
    protected $table = 'corpos';
    protected $fillable = [
        'nome',
        'laudo',
        'entrevista_id',
        'num_vo',
        'ano_vo',
        'status',
        'status_anterior',
        'sexo',
        'rg',
        'orgao_emissor',
        'estado_rg',
        'cpf',
        'endereco_corpo_id',
        'data_nascimento',
        'data_entrada',
        'data_obito',
        'local_obito',
        'situacao',
        'endereco_obito_id',
        'meio_transporte',
        'meio_transporte_outro',
        'funeraria_id',
        'funeraria_retirada_id',
        'responsavel_entrega_id',
        'responsavel_corpo_id',
        'necrotomista_id',
        'corpoSera',
        'pertences',
        'cadastradoPor',
        'encaminhar_liga',
        'pendencias',
        'observacoes',
        'medico_externo',
        'estabelecimento_obito',
        'cnes_estabelecimento',
        'natimorto',
        'encaminhar_itep',
        'nacionalidade',
        'tipo_documento',
        'numero_documento',
        'destino_do_corpo',
        'data_finalizacao',
        'data_recebimento',
        'digitador_id',
        'justificativa',
        'estabelecimento_destino',
    ];
    protected $guarded = ['id', 'created_at', 'update_at', 'deleted_at'];

    public function responsavelEntrega(){
        return $this->hasOne(Responsavel::class, 'id', 'responsavel_entrega_id');
    }
    public function necrotomista(){
        return $this->hasOne(User::class, 'id', 'necrotomista_id');
    }
    public function responsavelCorpo(){
        return $this->hasOne(Responsavel::class, 'id', 'responsavel_corpo_id');
    }
    public function enderecoCorpo(){
        return $this->hasOne(Endereco::class, 'id', 'endereco_corpo_id');
    }

    public function enderecoObito(){
        return $this->hasOne(Endereco::class, 'id', 'endereco_obito_id');
    }
    public function funeraria(){
        return $this->hasOne(Funeraria::class, 'id', 'funeraria_id');
    }
    public function user(){
        return $this->hasOne(User::class, 'id', 'cadastradoPor');
    }
    public function laudoInfo(){
        return $this->hasOne(Laudo::class, 'id', 'laudo');
    }
    public function orgaoEmissor(){
        return $this->hasOne(OrgaoEmissor::class, 'id', 'orgao_emissor');
    }
    public function corpoStatus(){
        return $this->hasOne(CorpoStatus::class, 'id', 'status');
    }
    public function medicoExterno(){
        return $this->hasOne(MedicoExterno::class, 'id', 'medico_externo');
    }
    public function entrevistaInfo(){
        return $this->hasOne(Entrevista::class, 'id', 'entrevista_id');
    }
}
