<?php

namespace App\Models;

use App\Helpers\UtilsHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable;

class UsuariosTipos extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use AuditingAuditable;

    public function generateTags(): array
    {
        return [
            UtilsHelpers::sqlWithBindings(DB::getQueryLog())
        ];
    } 

    protected $fillable = ['name'];
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];
    protected $table = 'usuarios_tipos';
}
