<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users\Employer;
use App\Models\Job;
use App\Models\Shared\Localisation\Country;
use App\Models\Shared\Localisation\State;
use App\Models\Shared\Localisation\City;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    public function __construct()
    {   
        $this->middleware('auth')->except(['register', 'registerStore']);
    }

    public function dashboard()
    {
        $userId = auth()->user()->id;
        $jobs = Job::where('owner_id', '=', $userId)->get();

        $data = [
            'jobs' => $jobs,
        ];

        return view('employers.dashboard', compact('data'));
    }

    // Create new user
    public function registerStore(Request $request)
{
    $formFields = $request->validate([
        'username' => ['required', 'min:3', 'max:255'],
        'email' => ['required', 'email', Rule::unique('employers', 'email')],
        'password' => ['required', 'confirmed', 'min:6', 'regex:/[A-Z]/', 'regex:/[!@#$%^&*(),.?":{}|<>]/'],
        'statute' => 'accepted',
    ]);

    $formFields['password'] = bcrypt($formFields['password']);

    $user = Employer::create($formFields);

    $user->sendEmailVerificationNotification();

    auth()->login($user);

    return redirect()->route('auth.verify')->with('message', 'Konto zostało utworzone. Sprawdź swój e-mail w celu weryfikacji konta.');
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
