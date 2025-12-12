<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Facades\DB;
use App\Helpers\UtilsHelpers;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditingAuditable;

class ExameDocumento extends Model implements Auditable
{
    use HasFactory;
    use AuditingAuditable;
    use SoftDeletes;
    protected $fillable = [
        'exame_id',
        'name', 
        'format', 
        'path',
        'enviado_por'
    ]; 
    protected $guarded = ['id', 'created_at', 'update_at', 'deleted_at'];
    protected $table = 'exames_documentos';

    public function generateTags(): array
    {
        return [
            UtilsHelpers::sqlWithBindings(DB::getQueryLog())
        ];
    }

    public function usuario(){
        return $this->hasOne(User::class, 'id', 'enviado_por');
    }
}
