<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if($request->expectsJson()){
            return null;
        }

        if ($request->is('employer/*')) {
            return route('employer.login');
        } elseif ($request->is('employee/*')) {
            return route('employee.login');
        } elseif ($request->is('editor/*')) {
            return route('editor.login');
        }

        if ($request->route()->gatherMiddleware() === ['auth.employer']) {
            return route('employers.showLoginForm');
        } elseif ($request->route()->gatherMiddleware() === ['auth.employee']) {
            return route('employee.showLoginForm');
        } elseif ($request->route()->gatherMiddleware() === ['auth.editor']) {
            return route('editor.showLoginForm');
        }


        return route('login');
    }
}
