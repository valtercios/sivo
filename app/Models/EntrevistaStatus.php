<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntrevistaStatus extends Model
{
    use HasFactory;
    protected $table = 'entrevistas_status';
    protected $fillable = [
        "descricao",
        "tipo"
    ];
    protected $guarded = ['id', 'created_at', 'update_at', 'deleted_at'];
}
