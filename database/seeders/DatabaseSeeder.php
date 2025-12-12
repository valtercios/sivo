<?php

namespace Database\Seeders;

use App\Models\SistemasCriticidade;
use App\Models\SistemasRiscoFinanceiro;
use App\Models\SistemasRiscoNegocio;
use App\Models\SistemasStatus;
use App\Models\SistemasUso;
use App\Models\UsuariosTipos;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(Permissions::class);
        $this->call(OrgaosEmissoresTableSeeder::class);
        $this->call(CorpoStatusTableSeeder::class);
        $this->call(LaudoStatusTableSeeder::class);
        $this->call(PapeisPermissionsSeeder::class);
        $this->call(PermissionsViewSeeder::class);
        $this->call(ExamesPermissionsSeeder::class);
        $this->call(EntrevistasPermissionsSeeder::class);
        $this->call(CBOTbOcupacaoSinonimosTableSeeder::class);
        $this->call(AtribuirVOPermissionSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(RoleHasPermissionsTableSeeder::class);
        $this->call(DadosTesteSeeder::class);
    }
}
