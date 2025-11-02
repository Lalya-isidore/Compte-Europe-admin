<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticateSubAccount
{
    public function handle($request, Closure $next)
    {
        if (!session()->has('sub_account_user_id')) {
            return redirect()->route('login');
        }

        // Vous pouvez ajouter d'autres vérifications ici si nécessaire

        return $next($request);
    }
}
