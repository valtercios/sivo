<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrgaoEmissor extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'sigla', 'tipo'];
    protected $guarded = ['id', 'created_at', 'update_at', 'deleted_at'];
    protected $table = 'orgaos_emissores';
}
