<?php

namespace App\Http\Controllers;

use App\Helpers\UtilsHelpers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Laravel\Fortify\Contracts\LoginViewResponse;
use Laravel\Fortify\Features;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Requests\LoginRequest;
use OwenIt\Auditing\Events\AuditCustom;


class AuthenticatedSessionController extends Controller
{

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {

        $user = Auth::user();
        $userAuditLog = User::find($user->id);
        $userAuditLog->auditEvent = 'logout';
        $userAuditLog->isCustomEvent = true;
        $userAuditLog->auditCustomOld = ['logout' => ''];
        $userAuditLog->auditCustomNew = ['logout' => true];
//        event(new AuditCustom($userAuditLog));
        Event::dispatch(AuditCustom::class, [$userAuditLog]);


        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
