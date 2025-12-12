<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorpoStatus extends Model
{
    use HasFactory;
    protected $table = 'corpo_status';
    protected $fillable = [
        "descricao",
        "tipo"
    ];
    protected $guarded = ['id'];
}
