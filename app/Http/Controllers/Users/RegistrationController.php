<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;

class RegistrationController extends Controller
{
    public function create($type = 'employee')
    {
        $data = [
            'label' => [
                'register-header' => 'Rejestracja',
                'employer' => 'pracodawca',
                'employee' => 'kandydat',
                'username' => 'nazwa użytkownika',
                'email' => 'email',
                'companyname' => 'nazwa firmy',
                'password' => 'hasło',
                'confirm_password' => 'potwierdź hasło',
                'acceptregulamin' => 'Przeczytałem i akceptuję',
                'regulamin' => 'regulamin',
                'register' => 'zarejestruj się',
            ],
            'activeTab' => $type
        ];
        return view('auth.register', compact('data'));
    }
}
