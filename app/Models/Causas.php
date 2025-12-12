<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Facades\DB;
use App\Helpers\UtilsHelpers;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditingAuditable;

class Causas extends Model implements Auditable
{
    use HasFactory;
    use AuditingAuditable;
    
    public function generateTags(): array
    {
        return [
            UtilsHelpers::sqlWithBindings(DB::getQueryLog())
        ];
    }
    protected $table = 'causas';
    protected $fillable = [
        'descricao',
        'tempo',
        'tipo_tempo',
        'cid'
    ];
    protected $guarded = ['id', 'created_at', 'update_at', 'deleted_at'];

    
}
