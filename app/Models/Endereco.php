<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Facades\DB;
use App\Helpers\UtilsHelpers;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditingAuditable;

class Endereco extends Model implements Auditable
{
    use HasFactory;
    use AuditingAuditable;
    use SoftDeletes;
    protected $fillable = ['cep','logradouro','bairro','cidade','estado','numero', 'complemento', 'corpo_id', 'pais','endereco_postal'];
    protected $guarded = ['id', 'created_at', 'update_at', 'deleted_at'];
    protected $table = 'enderecos';

    public function generateTags(): array
    {
        return [
            UtilsHelpers::sqlWithBindings(DB::getQueryLog())
        ];
    }
}