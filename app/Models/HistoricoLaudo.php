<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoricoLaudo extends Model
{
    use HasFactory;

    protected $table = 'historico_laudo';

    protected $fillable = ['laudo_id', 'new_values', 'old_values', 'user_id'];

    public function laudo()
    {
        return $this->belongsTo(Laudo::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
