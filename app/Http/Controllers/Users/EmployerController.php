<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users\Employer;
use App\Models\Shared\Localisation\Country;
use App\Models\Shared\Localisation\State;
use App\Models\Shared\Localisation\City;

class EmployerController extends Controller
{

    public function __construct()
    {   
        $this->middleware('auth');
    }

    public function index()
    {
        $employers = Employer::all();
        return view('employer.index', compact('employers'));
    }

    public function add()
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

    public function store()
    {

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

    public function delete()
    {

    }

    public function search()
    {

    }
}
