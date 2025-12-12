<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Laravel\Jetstream\Jetstream;
use App\Helpers\UtilsHelpers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use OwenIt\Auditing\Events\AuditCustom;

class JetstreamServiceProvider extends ServiceProvider
{


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->configurePermissions();

        Jetstream::deleteUsersUsing(DeleteUser::class);

        Fortify::authenticateUsing(function (Request $request) {
            $cpfApenasNumeros = preg_replace('/[^0-9]/', '', $request->identity);
            $user = User::where('cpf', $cpfApenasNumeros)
                // ->orWhere('username', $request->identity)
                // ->orWhere('email', $request->identity)
                ->first();
            if ($user && Hash::check($request->password, $user->password))
            {
                $userAuditLog = User::find($user->id);
                $userAuditLog->auditEvent = 'login';
                $userAuditLog->isCustomEvent = true;
                $userAuditLog->auditCustomOld = ['login' => ''];
                $userAuditLog->auditCustomNew = ['login' => true]; 
                Event::dispatch(AuditCustom::class, [$userAuditLog]);
                return $user;
            }
            
        });
    }

    /**
     * Configure the permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions()
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }
}
