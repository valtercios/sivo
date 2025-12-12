<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class Permissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'Administrador',
            'guard_name' => 'web',
            'created_at' => now(),
        ]);
        // Permissões dos corpos
        DB::table('permissions')->insert([
            'name' => 'corpos_create',
            'guard_name' => 'web',
            'descricao' => 'Permite o cadastro de novos corpos',
            'created_at' => now(),
        ]);
        DB::table('permissions')->insert([
            'name' => 'corpos_view',
            'guard_name' => 'web',
            'descricao' => 'Permite a visualização dos corpos',
            'created_at' => now(),
        ]);
        DB::table('permissions')->insert([
            'name' => 'corpos_edit',
            'guard_name' => 'web',
            'descricao' => 'Permite a edição dos corpos',
            'created_at' => now(),
        ]);
        DB::table('permissions')->insert([
            'name' => 'corpos_delete',
            'guard_name' => 'web',
            'descricao' => 'Permite a deleção dos corpos',
            'created_at' => now(),
        ]);
        // Permissões dos usuários
        DB::table('permissions')->insert([
            'name' => 'usuarios_create',
            'guard_name' => 'web',
            'descricao' => 'Permite o cadastro de novos usuários',
            'created_at' => now(),
        ]);
        DB::table('permissions')->insert([
            'name' => 'usuarios_view',
            'guard_name' => 'web',
            'descricao' => 'Permite a visualização dos usuários',
            'created_at' => now(),
        ]);
        DB::table('permissions')->insert([
            'name' => 'usuarios_edit',
            'guard_name' => 'web',
            'descricao' => 'Permite a edição dos usuários',
            'created_at' => now(),
        ]);
        DB::table('permissions')->insert([
            'name' => 'usuarios_delete',
            'guard_name' => 'web',
            'descricao' => 'Permite a deleção dos usuários',
            'created_at' => now(),
        ]);

        
        // Permissões das funerárias
        DB::table('permissions')->insert([
            'name' => 'funerarias_create',
            'guard_name' => 'web',
            'descricao' => 'Permite o cadastro de novas funerárias',
            'created_at' => now(),
        ]);
        DB::table('permissions')->insert([
            'name' => 'funerarias_view',
            'guard_name' => 'web',
            'descricao' => 'Permite a visualização das funerárias',
            'created_at' => now(),
        ]);
        DB::table('permissions')->insert([
            'name' => 'funerarias_edit',
            'guard_name' => 'web',
            'descricao' => 'Permite a edição das funerárias',
            'created_at' => now(),
        ]);
        DB::table('permissions')->insert([
            'name' => 'funerarias_delete',
            'guard_name' => 'web',
            'descricao' => 'Permite a deleção das funerárias',
            'created_at' => now(),
        ]);
        // Permissões dos laudos
        DB::table('permissions')->insert([
            'name' => 'laudos_create',
            'guard_name' => 'web',
            'descricao' => 'Permite o cadastro de novos laudos.',
            'created_at' => now(),
        ]);
        DB::table('permissions')->insert([
            'name' => 'laudos_view',
            'guard_name' => 'web',
            'descricao' => 'Permite a visualização dos laudos.',
            'created_at' => now(),
        ]);
        DB::table('permissions')->insert([
            'name' => 'laudos_edit',
            'guard_name' => 'web',
            'descricao' => 'Permite a edição dos laudos.',
            'created_at' => now(),
        ]);
        DB::table('permissions')->insert([
            'name' => 'laudos_delete',
            'guard_name' => 'web',
            'descricao' => 'Permite a deleção dos laudos.',
            'created_at' => now(),
        ]);

        // Permissões dos laudos
        DB::table('permissions')->insert([
            'name' => 'responsaveis_create',
            'guard_name' => 'web',
            'descricao' => 'Permite o cadastro de novos responsáveis',
            'created_at' => now(),
        ]);
        DB::table('permissions')->insert([
            'name' => 'responsaveis_view',
            'guard_name' => 'web',
            'descricao' => 'Permite a visualização dos responsáveis',
            'created_at' => now(),
        ]);
        DB::table('permissions')->insert([
            'name' => 'responsaveis_edit',
            'guard_name' => 'web',
            'descricao' => 'Permite a edição dos responsáveis',
            'created_at' => now(),
        ]);
        DB::table('permissions')->insert([
            'name' => 'responsaveis_delete',
            'guard_name' => 'web',
            'descricao' => 'Permite a deleção dos responsáveis',
            'created_at' => now(),
        ]);


        // Permissões dos documentos da recepcao
        DB::table('permissions')->insert([
            'name' => 'documentos_recepcao_view',
            'guard_name' => 'web',
            'descricao' => 'Permite a visualização dos documentos da recepção',
            'created_at' => now(),
        ]);
        DB::table('permissions')->insert([
            'name' => 'documentos_recepcao_generate',
            'guard_name' => 'web',
            'descricao' => 'Permite a geração dos documentos da recepção',
            'created_at' => now(),
        ]);
        DB::table('permissions')->insert([
            'name' => 'documentos_recepcao_upload',
            'guard_name' => 'web',
            'descricao' => 'Permite o upload dos documentos da recepção',
            'created_at' => now(),
        ]);

        // Permissões dos documentos do serviço social
        DB::table('permissions')->insert([
            'name' => 'documentos_servico_social_view',
            'guard_name' => 'web',
            'descricao' => 'Permite a visualização dos documentos do serviço social',
            'created_at' => now(),
        ]);
        DB::table('permissions')->insert([
            'name' => 'documentos_servico_social_generate',
            'guard_name' => 'web',
            'descricao' => 'Permite a geração dos documentos do serviço social',
            'created_at' => now(),
        ]);
        DB::table('permissions')->insert([
            'name' => 'documentos_servico_social_upload',
            'guard_name' => 'web',
            'descricao' => 'Permite o upload dos documentos do serviço social',
            'created_at' => now(),
        ]);

        //Permissões documentos do médico
        DB::table('permissions')->insert([
            'name' => 'documentos_medico_view',
            'guard_name' => 'web',
            'descricao' => 'Permite a visualização dos documentos do médico',
            'created_at' => now(),
        ]);

        // Permissões audits
        DB::table('permissions')->insert([
            'name' => 'audits_view',
            'guard_name' => 'web',
            'descricao' => 'Permite a visualização dos logs de auditoria',
            'created_at' => now(),
        ]);

        $superadmin = User::where('username','admin')->first();

        $superadmin->assignRole('Administrador');


    }
}
