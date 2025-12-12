<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Facades\DB;
use App\Helpers\UtilsHelpers;
use OwenIt\Auditing\Auditable as AuditingAuditable;


class Unidade extends Model implements Auditable
{
    use HasFactory;
    use AuditingAuditable;
    
    protected $table = 'unidades';
    protected $guarded = ['id', 'created_at', 'update_at', 'deleted_at'];

    protected $fillable = [
        'cnes',
        'nome',
        'sigla_nome',
        'endereco_unidade',
        'complemento',
        'cep',
        'telefone',
        'email',
    ];

    public function generateTags(): array
    {
        return [
            UtilsHelpers::sqlWithBindings(DB::getQueryLog())
        ];
    }
    
}
