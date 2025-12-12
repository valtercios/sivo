<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicoExterno extends Model
{
    use HasFactory;

    protected $table = 'medico_externo';
    protected $fillable = ['nome', 'crm', 'telefone', 'endereco_id'];
    protected $guarded = ['id', 'created_at', 'update_at'];
}
