<?php

namespace App\Actions\Fortify;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\ResetsUserPasswords;

class ResetUserPassword implements ResetsUserPasswords
{
    use PasswordValidationRules;
    public function __construct()
    {
        DB::enableQueryLog();
     
    }
    /**
     * Validate and reset the user's forgotten password.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */

    public function reset($user, array $input)
    {
        Validator::make($input, [
            'password' => $this->passwordRules(),
        ])->validate();

        $result = $user->forceFill([
            'password' => Hash::make($input['password']),
        ])->save();
        
        if($result){
            return redirect()->route('login')->with('toast_success', 'Senha alterada com sucesso!');
        }
    }
}
