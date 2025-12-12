<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoricoCorpo extends Model
{
    use HasFactory;

    protected $table = 'historico_corpo';
    protected $fillable = ['titulo', 'conteudo', 'icon', 'corpo_id'];
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
