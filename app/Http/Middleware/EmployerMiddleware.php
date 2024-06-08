<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EmployerMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::guard('employer')->check()) {
        return $next($request);
        }
        elseif(Auth::guard('employee')->check()) {
        return redirect()->route('jobs')->withErrors(['message' => 'Jesteś zalogowany jako pracodawca. Musisz zalogować się jako pracownik, aby podjąć tę akcję.']);
        }
        elseif(Auth::guard('editor')->check()) {
        return redirect()->route('jobs')->withErrors(['message' => 'Jesteś zalogowany jako pracodawca. Musisz zalogować się jako edytor, aby podjąć tę akcję.']);
        }

        return redirect()->route('login')->withErrors(['message' => 'Musisz być zalogowany jako pracodawca.']);
    }
}
