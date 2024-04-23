<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Accommodation;
use App\Models\Shared\APhoto;
use App\Models\Shared\AccommodationCategory;
use App\Models\Shared\Currency;
use App\Models\Shared\Localisation\Country;
use App\Models\Shared\Localisation\State;
use App\Models\Shared\Localisation\City;


class AccommodationController extends Controller
{
    const Accommodation_PER_PAGE = 10;
    /**
     * Show all jobs.
     *
     * @return void
     */
    public function index()
    {
        $data = [];
        return view('jobs.index', [
            'data' => $data,
        ]);
    }

    /**
     * Show add job form.
     *
     * @return void
     */
    public function add()
    {
        $accommodation = new Accommodation();

        $hasExistingPhoto = !empty($accommodation->main_image_path);
        $hasExistingPhotos = $accommodation->photos()->exists();

        $accommodationCategory = AccommodationCategory::all();
        $currency = Currency::all();
        $photos = APhoto::all();
        $countries = Country::get(["country", "id"]);

        $data = [
            'accommodation' => [
                'accommodationCategory' => $accommodationCategory,
                'currency' => $currency,
            ],
            'photos' => [
                'hasExistingPhoto' => $hasExistingPhoto,
                'hasExistingPhotos' => $hasExistingPhotos,
                'photos' => $photos
            ],
            'countries' => $countries
        ];

        return view('accommodation.add', [
            'data' => $data,
        ]);
    }

    public function getState(Request $request)
    {
        $data["states"] = State::where("country_id", $request->country_id)->get(["state", "id"]);
        return response()->json($data);
    }

    public function getCountry(Request $request)
    {
        $data["cities"] = City::where("state_id", $request->state_id)->get(["city", "id"]);
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
}
