<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaudoStatus extends Model
{
    use HasFactory;
    protected $table = 'laudo_status';
    protected $fillable = [
        "descricao",
        "tipo"
    ];
    protected $guarded = ['id'];
}
