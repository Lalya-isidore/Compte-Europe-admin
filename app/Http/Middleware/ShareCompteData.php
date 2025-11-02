<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Compte;

class ShareCompteData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->session()->has('token')) {
            $token = $request->session()->get('token');
            $compte = Compte::where('token', $token)->first();
            if ($compte) {
                view()->share('compte', $compte);
            }
        }

        return $next($request);
    }
}
