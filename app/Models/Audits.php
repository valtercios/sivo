<?php

namespace App\Models;

use App\Helpers\UtilsHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Audits extends Model 
{
    use HasFactory;

    protected $fillable = ['user_type','user_id','event','auditable_type','auditable_id','old_values','new_values','url','ip_address', 'user_agent','tags'];
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];
    protected $table = 'audits';

    public function usuario(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
