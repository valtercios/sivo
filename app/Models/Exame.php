<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Facades\DB;
use App\Helpers\UtilsHelpers;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditingAuditable;

class Exame extends Model implements Auditable
{
    use HasFactory;
    use AuditingAuditable;
    use SoftDeletes;
    protected $fillable = [
        'status_id',
        'tipo_exame',
        'observacao', 
        'corpo_id', 
        'solicitado_por',
        'resposta',
        'respondido_por',
    ]; 
    protected $guarded = ['id', 'created_at', 'update_at', 'deleted_at'];
    protected $table = 'exames';

    public function generateTags(): array
    {
        return [
            UtilsHelpers::sqlWithBindings(DB::getQueryLog())
        ];
    }

    public function status(){
        return $this->hasOne(ExameStatus::class, 'id', 'status_id');
    }
    public function corpo(){
        return $this->hasOne(Corpo::class, 'id', 'corpo_id');
    }
    public function solicitante(){
        return $this->hasOne(User::class, 'id', 'solicitado_por');
    }
    public function usuarioResposta(){
        return $this->hasOne(User::class, 'id', 'respondido_por');
    }
    
}
