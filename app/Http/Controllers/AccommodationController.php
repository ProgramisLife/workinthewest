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
use App\Http\Requests\Accommodation\AccommodationRequest;


class AccommodationController extends Controller
{
    const ACCOMMODATION_PER_PAGE = 10;
    /**
     * Show all jobs.
     *
     * @return void
     */
    public function index()
    {
        $news = Accommodation::orderBy('created_at', 'DESC')->paginate(self::ACCOMMODATION_PER_PAGE);
        $featureds = Accommodation::where('featured', true)->paginate(self::ACCOMMODATION_PER_PAGE);

        $currentDate = Carbon::now();

        $yearsDifference = 0;
        $monthsDifference = 0;
        $daysDifference = 0;
        $hoursDifference = 0;
        $minutesDifference = 0;

        foreach ($news as $new) {
        $createdAt = $new->created_at;
        $diff = $currentDate->diff($createdAt);

        $yearsDifference = $diff->y;
        $monthsDifference = $diff->m;
        $daysDifference = $diff->d;
        $hoursDifference = $diff->h;
        $minutesDifference = $diff->i;
    }

        $data = [
            'accommodation' => [
                'news' => $news,
                'featureds' => $featureds,
            ],
            'label' => [
                'newest' => 'najnowsze oferty',
                'featured' => 'wyróżnione',
                'empty' => 'Brak ogłoszeń',
            ],
            'date' => [
                'yearsDifference' => $yearsDifference,
                'monthsDifference' => $monthsDifference,
                'daysDifference' => $daysDifference,
                'hoursDifference' => $hoursDifference,
                'minutesDifference' => $minutesDifference,
            ],
        ];
        return view('accommodation.index', [
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
        $expiry = Carbon::now()->addDays(30)->format('Y-m-d');
        $currency = Currency::all();
        $photos = APhoto::all();
        $countries = Country::get(["country", "id"]);

        $data = [
            'accommodation' => [
                'accommodationCategory' => $accommodationCategory,
                'currency' => $currency,
                'expiry' => $expiry,
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

    public function getCity(Request $request)
    {
        $data["cities"] = City::where("state_id", $request->state_id)->get(["city", "id"]);
        return response()->json($data);
    }


    public function store(AccommodationRequest $accommodationRequest)
    {
        $accommodation = new Accommodation($accommodationRequest->validated());

        $accommodation->slug;

        $accommodation->currency()->associate($accommodationRequest->input('currency'));

        $accommodation->country()->associate($accommodationRequest->input('countries'));

        $accommodation->state()->associate($accommodationRequest->input('states'));

        $accommodation->city()->associate($accommodationRequest->input('cities'));

        $accommodation->save();

         if ($accommodationRequest->hasFile('photo')) {
            $photo = $accommodationRequest->file('photo');
            $imageName = uniqid() . '_' . $photo->getClientOriginalName();

            if ($photo->isValid() && strpos($photo->getMimeType(), 'image/') !== false) {
                $photo->move(public_path('images/accommodation/main-photo'), $imageName);
                $accommodation->main_image_path = $imageName;
            } else {
                session()->flash('status', 'Nieprawidłowe zdjęcie');
            }
        }

        $accommodation->photos()->sync($accommodationRequest->input('photos'));

        if ($accommodationRequest->hasFile('photos')) {
            foreach ($accommodationRequest->file('photos') as $photo) {
                $imageName = time() . '_' . $photo->getClientOriginalName();
                $photo->move(public_path('images/accommodation/photos'), $imageName);

                $newPhoto = new APhoto();
                $newPhoto->photo = $imageName;
                $newPhoto->save();

                $accommodation->photos()->attach($newPhoto->id);
            }
        }

        if ($accommodation->save($accommodationRequest->validated())) {
            session()->flash('status', ('Twoja oferta został pomyślnie zapisana'));
        } else {
            session()->flash('status', ('Coś poszło nie tak :('));
        }

        return redirect()->route('accommodation.show',['accommodation' => $accommodation]);
    }


    public function show(Accommodation $accommodation)
    {
        $accommodationSimilarCategorys = Accommodation::where('id', $accommodation->country_id && $accommodation->state_id)
            ->where('id', '!=', $accommodation->id)
            ->get();
        return view('accommodation.show', [
            'accommodation' => $accommodation,
            'accommodationSimilarCategorys' => $accommodationSimilarCategorys,
        ]);
    }


    public function edit(Accommodation $accommodation)
    {
    }


    public function update()
    {
    }


    public function delete(Accommodation $accommodation)
    {
        if ($accommodation->delete()) {
            session()->flash('status', 'Twoja oferta została usunięta.');
        } else {
            session()->flash('status', 'Wystąpił błąd podczas usuwania Twojej oferty pracy :(');
        }

        return redirect()->route('accommodation.index');
    }

    public function search(Request $request)
    {
        $data = 'coś';
        return response()->json($data);
    }
}
