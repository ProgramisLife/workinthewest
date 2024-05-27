<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users\Employer;
use App\Models\Shared\Localisation\Country;
use App\Models\Shared\Localisation\State;
use App\Models\Shared\Localisation\City;
use App\Http\Requests\Users\EmployerRequest;
use App\Models\User;
use Faker\Calculator\Ean;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;

class EmployerController extends Controller
{

    public function __construct()
    {   
        $this->middleware('auth')->except(['register', 'store']);
    }

    public function index()
    {
        $employers = Employer::all();
        return view('employers.index', compact('employers'));
    }

    public function register()
    {
        $data = [
            'label' => [
                'top' => [
                    'register' => 'Rejestracja'
                ],
                'register-forms' => [
                    'user-name' => 'nazwa użytkownika',
                    'email' => 'email',
                    'companyname' => 'nazwa firmy',
                    'password' => 'hasło',
                    'password-repeat' => 'powtórz hasło',
                    'statute' => 'Oświadczam, że znam i akceptuję postanowienia Regulaminu'
                ],
            ],
        ];
        return view('employers.register', compact('data'));
    }

    
    public function store(EmployerRequest $employerRequest)
    {
        $employer = new Employer($employerRequest->validated());

        $user = $this->create($employerRequest->all());

        auth()->login($user);

        redirect()->route('employers.show',['employer' => $employer->id]);
    }
    
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['username'],
            'email' => $data['email'],
            'companyname' => $data['companyname'],
            'password' => Hash::make($data['password']),
        ]);
    }
    
    public function show()
    {
        
    }
    
    public function edit()
    {
        
    }
    
    public function update()
    {
        
    }

    public function getState(Request $request){
        $data['states'] = State::where('country_id', $request->country_id)->get(['state', 'id']);
        return response()->json($data);
    }

    public function getCity(Request $request){
        $data['cities'] = City::where('state_id', $request->state_id)->get(['city', 'id']);
        return response()->json($data);
    }
    
    public function delete()
    {
        
    }
    
    public function search()
    {

    }
}
