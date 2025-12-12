<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PrimeiroAcesso
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->atualizacao == 0 || auth()->user()->atualizacao == null){
            return redirect()->route('usuarios.primeiroacesso');
        }
        return $next($request);
    }
}
