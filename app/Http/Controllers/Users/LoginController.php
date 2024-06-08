<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/jobs';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login()
    {
        $data = [
            'label' => [
                'login' => 'Logowanie',
                'email' => 'E-mail',
                'password' => 'hasło',
                'remember' => 'Zapamiętaj mnie',
                'logi-me' => 'Zaloguj się',
                'dontremember' => "Zapomniałeś hasła?",
                'register' => 'Zarejestruj się',
            ],
        ];
        return view('auth.login', ['data' => $data]);
    }

    public function authentication(Request $request)
    {
        $credentials =  $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if (Auth::guard('employer')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('employers.dashboard')->with('message', 'Zostałeś zalogowany!');
        }

        if (Auth::guard('employee')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('employee.dashboard')->with('message', 'Zostałeś zalogowany!');
        }

        if (Auth::guard('editor')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('editor.dashboard')->with('message', 'Zostałeś zalogowany!');
        }

        return back()->withErrors(['email' => 'Konto z podanym adresem e-mail i hasłem nie istnieje'])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        Auth::guard('employer')->logout();
        Auth::guard('employee')->logout();
        Auth::guard('editor')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
