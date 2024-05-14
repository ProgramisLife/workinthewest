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
        $accommodationSimilarCategorys = $accommodation->accommodationcategory->pluck('id');
        $similarAccommodations = Accommodation::whereHas('accommodationcategory', function($query) use ($accommodationSimilarCategorys) {
        $query->whereIn('id', $accommodationSimilarCategorys);
        })->where('id', '!=', $accommodation->id)->get();
        return view('accommodation.show', [
            'accommodation' => $accommodation,
            'similarAccommodations' => $similarAccommodations,
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
        $news = Accommodation::orderBy('created_at', 'DESC')->paginate(self::ACCOMMODATION_PER_PAGE);
        $featureds = Accommodation::where('featured', true)->paginate(self::ACCOMMODATION_PER_PAGE);

        $currentDate = Carbon::now();

        // Parametry wyszukiwania
        $keyword = $request->input('keyword');
        $localisation = $request->input('localisation');

        // Sortowanie
        $sortBy = $request->input('sorting');

        $query = Accommodation::query();

        if ($sortBy == 'low')
        {
            $query->orderBy('price_buy', 'asc');
        }
        else if ($sortBy == 'low_rent')
        {
            $query->orderBy('price_rent', 'asc');
        }
        else if ($sortBy == 'high_buy')
        {
            $query->orderBy('price_buy', 'desc');
        }
        else if ($sortBy == 'high_rent')
        {
            $query->orderBy('price_rent', 'desc');
        }
        else
        {
            $query->orderBy('created_at', 'desc');
        }

        $query->when(!is_null($keyword), function ($query) use ($keyword) {
            return is_numeric($keyword) 
                ? $query->where(function ($query) use ($keyword) {
                    $query->where('price_buy', '<=', $keyword)
                        ->orWhere('price_rent', '<=', $keyword);
                }) 
                : $query->where(function ($query) use ($keyword) {
                    $query->where('title', 'like', "%$keyword%")
                        ->orWhereHas('accommodationcategory', function ($query) use ($keyword) {
                            $query->where('name', 'like', "%$keyword%");
                        })
                        ->orWhere('email', 'like', "%$keyword%")
                        ->orWhere('contact', 'like', "%$keyword%")
                        ->orWhere('phone_number', 'like', "%$keyword%")
                        ->orWhere('phone_number', 'like', "%$keyword%");
                });
        })
        ->when(!is_null($localisation), function ($query) use ($localisation) {
            return $query->when(!is_null($localisation), function ($query) use ($localisation) {
                return $query->whereHas('country', function ($query) use ($localisation) {
                    $query->where('country', 'like', "%$localisation%");
                })
                ->orWhereHas('state', function ($query) use ($localisation) {
                    $query->where('state', 'like', "%$localisation%");
                })
                ->orWhereHas('city', function ($query) use ($localisation) {
                    $query->where('city', 'like', "%$localisation%");
                });
            });
        });
        
        $accommodationSearchs = $query->paginate(12);

        $yearsDifference = 0;
        $monthsDifference = 0;
        $daysDifference = 0;
        $hoursDifference = 0;
        $minutesDifference = 0;

        foreach ($accommodationSearchs as $accommodation) {
        $createdAt = $accommodation->created_at;
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
                'accommodationSearchs' => $accommodationSearchs
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
        return view('accommodation.index', ['data' => $data]);
    }
}
