<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EditorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::guard('editor')->check()) {
        return $next($request);
        }
        elseif(Auth::guard('employer')->check()) {
        return redirect()->route('jobs')->withErrors(['message' => 'Jesteś zalogowany jako edytor. Musisz zalogować się jako pracodawca, aby podjąć tę akcję.']);
        }
        elseif(Auth::guard('employee')->check()) {
        return redirect()->route('jobs')->withErrors(['message' => 'Jesteś zalogowany jako edytor. Musisz zalogować się jako pracownik, aby podjąć tę akcję.']);
        }

        return redirect()->route('login')->withErrors(['message' => 'Musisz być zalogowany jako edytor.']);
    }
}
