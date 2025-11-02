<?php

// namespace App\Http\Middleware;

// use Closure;
// use Illuminate\Support\Facades\Config;

// class SubAccountSessionMiddleware
// {
//     /**
//      * Handle an incoming request.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @param  \Closure  $next
//      * @return mixed
//      */
//     public function handle($request, Closure $next)
//     {
//         // Changer les configurations de la session pour utiliser celles des sous-comptes
//         Config::set('session.driver', Config::get('session.sub_account.driver'));
//         Config::set('session.table', Config::get('session.sub_account.table'));

//         return $next($request);
//     }
// }
