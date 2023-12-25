<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CheckUserProfileOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $requestedUserId = $request->route('user')->id;

        if (Auth::id() != $requestedUserId) {
            return redirect()
                ->route('index')
                ->with('error', 'Unauthorized access');
            Alert::error('Erreur', "Vous n'avez pas accès à cette page");
        }

        return $next($request);
    }
}
