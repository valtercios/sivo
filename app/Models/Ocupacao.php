<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ocupacao extends Model
{
    use HasFactory;

    protected $table = 'tb_ocupacao_sinonimos';
    protected $fillable = ['ds_ocupacao', 'co_cbo', 'TIPO'];
    protected $guarded = ['id', 'created_at', 'updated_at'];
}


