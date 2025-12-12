<?php

namespace App\Models;

use App\Helpers\UtilsHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable;

class Documento extends Model implements Auditable
{
    use HasFactory;
    use AuditingAuditable;

    public function generateTags(): array
    {
        return [
            UtilsHelpers::sqlWithBindings(DB::getQueryLog()),
        ];
    }
    protected $table = 'documentos';
    protected $fillable = [
        'name',
        'format',
        'path',
        'enviado_por',
        'tipo_documento',
        'papel_documento',
    ];
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'enviado_por');
    }
}
