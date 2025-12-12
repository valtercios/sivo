<?php

namespace App\Models;

use App\Helpers\UtilsHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable;

class Laudo extends Model implements Auditable
{
    use HasFactory;
    use AuditingAuditable;

    public function generateTags(): array
    {
        return [
            UtilsHelpers::sqlWithBindings(DB::getQueryLog()),
        ];
    }

    protected $table = 'laudos';

    protected $fillable = [
        'id_corpo',
        'status',
        'status_anterior',
        'entrevista_id',
        'medico',
        'file_path',
        'file_name',
        'historico',
        'exame_geral',
        'exame_cabeca',
        'exame_torax',
        'exame_abdome',
        'exame_genitalia',
        'exame_membros',
        'exame_macroscopia',
        'exame_microscopia',
        'exame_conclusoes',
        'exame_necroscopico',
        'causa_a_id',
        'causa_b_id',
        'causa_c_id',
        'causa_d_id',
        'causa_outras1_id',
        'causa_outras2_id',
        'encaminhar_itep',
        'data_exame',
        'digitador_id'
        
    ];

    public function corpo()
    {
        return $this->hasOne(Corpo::class, 'id', 'id_corpo');
    }
    public function causa_a()
    {
        return $this->hasOne(Causas::class, 'id', 'causa_a_id');
    }
    public function causa_b()
    {
        return $this->hasOne(Causas::class, 'id', 'causa_b_id');
    }
    public function causa_c()
    {
        return $this->hasOne(Causas::class, 'id', 'causa_c_id');
    }
    public function causa_d()
    {
        return $this->hasOne(Causas::class, 'id', 'causa_d_id');
    }
    public function causa_outras1()
    {
        return $this->hasOne(Causas::class, 'id', 'causa_outras1_id');
    }
    public function causa_outras2()
    {
        return $this->hasOne(Causas::class, 'id', 'causa_outras2_id');
    }
    public function laudoStatus()
    {
        return $this->hasOne(LaudoStatus::class, 'id', 'status');
    }
    public function ocupacaoInfo()
    {
        return $this->hasOne(Ocupacao::class, 'id', 'ocupacao');
    }
    public function entrevistaInfo()
    {
        return $this->hasOne(Entrevista::class, 'id', 'entrevista_id');
    }
    public function digitador()
    {
        return $this->hasOne(User::class, 'id', 'digitador_id');
    }
    public function medico()
    {
        return $this->hasOne(User::class, 'id', 'medico');
    }

    public function historicoLaudo()
    {
        return $this->hasMany(HistoricoLaudo::class);
    }

    protected static function boot()
    {
        parent::boot();
    
        static::updated(function ($laudo) {
            $alteracoes = $laudo->getDirty();
            $valores_antigos = [];
    
            foreach ($alteracoes as $campo => $novo_valor) {
                $valores_antigos[$campo] = $laudo->getOriginal($campo);
            }
    
            $laudo->historicoLaudo()->create([
                'new_values' => json_encode($alteracoes),
                'old_values' => json_encode($valores_antigos),
                'user_id' => auth()->id(),
            ]);
        });
    }
}
