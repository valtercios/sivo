<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;
use App\Notifications\ResetPassword;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Facades\DB;
use App\Helpers\UtilsHelpers;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditingAuditable;


class User extends Authenticatable implements Auditable
{
    
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    use AuditingAuditable;
    use SoftDeletes;

    public function generateTags(): array
    {
        return [
            UtilsHelpers::sqlWithBindings(DB::getQueryLog())
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'username',
        'cpf',
        'email',
        'password',
        'crm',
        'cadastrado_por',
        'tipo_user_id',
        'editado_por',
        'processos_view',
        'image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function hasPermission(Permission $permission)
    {
        # code...
        return $this->hasAnyRoles($permission->roles);
    }

    #verifica se o usuario logado tem a função especifica;
    public function hasAnyRoles($roles)
    {
        if (is_array($roles) || is_object($roles)) {
            return !!$roles->intersect($this->roles)->count();
        }
        return $this->roles->contains('name', $roles);
    }
    public function criado()
    {
        return $this->hasOne(User::class, 'id', 'cadastrado_por');
    }
    public function editado()
    {
        return $this->hasOne(User::class, 'id', 'editado_por');
    }

    // Enviar email traduziado
    /* public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    } */
}
