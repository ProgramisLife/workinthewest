<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Http\Requests\Job\JobRequest;
use App\Models\Job;
use App\Models\Shared\Currency;
use App\Models\Shared\JobCategory;
use App\Models\Shared\JobLevel;
use App\Models\Shared\JobType;
use App\Models\Shared\Language;
use App\Models\Shared\Photo;
use App\Models\Shared\Skill;
use App\Models\Shared\JobState;
use App\Models\Shared\Localisation\Country;
use App\Models\Shared\Localisation\State;
use App\Models\Shared\Localisation\City;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{
    const JOBS_PER_PAGE = 10;
    /**
     * Show all jobs.
     *
     * @return void
     */
    public function index()
    {
        $newArticles = Article::orderBy('created_at', 'DESC')->paginate(self::JOBS_PER_PAGE);

        $jobCategories = JobCategory::all();

        $newJobs = Job::orderBy('created_at', 'DESC')->paginate(self::JOBS_PER_PAGE);

        $featuredJobs = Job::where('featured', true)->paginate(self::JOBS_PER_PAGE);

        $currentDate = Carbon::now();

        $jobstate = JobState::all();

        $yearsDifference = 0;
        $monthsDifference = 0;
        $daysDifference = 0;
        $hoursDifference = 0;
        $minutesDifference = 0;

        foreach ($newJobs as $job) {
        $createdAt = $job->created_at;
        $diff = $currentDate->diff($createdAt);

        // Tutaj możesz wykorzystać różnicę czasu dla każdego rekordu
        $yearsDifference = $diff->y;
        $monthsDifference = $diff->m;
        $daysDifference = $diff->d;
        $hoursDifference = $diff->h;
        $minutesDifference = $diff->i;
    }


        $data = [
            'jobs' => [
                'newJobs' => $newJobs,
                'featuredJobs' => $featuredJobs,
                'jobstate' => $jobstate,
            ],
            'label' => [
                'cooperation' => 'współpracujemy:',
                'empty' => 'Brak ofert pracy',
                'news' => 'Centrum Aktualności',
                'news-content' => 'Tutaj możesz śledzić najnowsze newsy z świata pracy.',
                'articles' => 'Brak artykułów do wyświetlenia.',
                'business-register' => 'Zarejestruj firmę',
                'newest-ofert' => 'Najnowsze oferty',
                'featured-ofert' => 'Wyróżnione',
            ],
            'categories' => $jobCategories,
            'date' => [
                'yearsDifference' => $yearsDifference,
                'monthsDifference' => $monthsDifference,
                'daysDifference' => $daysDifference,
                'hoursDifference' => $hoursDifference,
                'minutesDifference' => $minutesDifference,
            ],
        ];
        return view('jobs.index', [
            'data' => $data,
            'newArticles' => $newArticles,
        ]);
    }

    /**
     * Show add job form.
     *
     * @return void
     */
    public function add()
    {
        $job = new Job();
        $hasExistingPhoto = !empty($job->main_image_path);
        $hasExistingPhotos = $job->photos()->exists();

        $sexOptions = ['Mężczyzna', 'Kobieta', 'Inne'];
        $jobCategories = JobCategory::all();
        $joblevels = JobLevel::all();
        $jobtypes = JobType::all();
        $jobcurrencies = Currency::all();
        $languages = Language::all();
        $photos = Photo::all();
        $skills = Skill::all();
        $expiry = Carbon::now()->addDays(30)->format('Y-m-d');
        $countries = Country::get(["country", "id"]);
        $jobstate = JobState::all();


        $data = [
            'job' => [
                'sexOptions' => $sexOptions,
                'jobcategories' => $jobCategories,
                'joblevels' => $joblevels,
                'jobtypes' => $jobtypes,
                'jobcurrencies' => $jobcurrencies,
                'joblanguages' => $languages,
                'jobskills' => $skills,
                'jobphotos' => $photos,
                'expiry' => $expiry,
                'jobstate' => $jobstate
            ],
            'photo' => [
                'hasExistingPhoto' => $hasExistingPhoto,
                'hasExistingPhotos' => $hasExistingPhotos,
            ],
            'countries' => $countries
        ];
        return view('jobs.add', [
            'data' => $data
        ]);
    }

    public function getState(Request $request){
        $data['states'] = State::where('country_id', $request->country_id)->get(['state', 'id']);
        return response()->json($data);
    }

    public function getCity(Request $request){
        $data['cities'] = City::where('state_id', $request->state_id)->get(['city', 'id']);
        return response()->json($data);
    }


    public function store(JobRequest $jobrequest)
    {
        $job = new Job($jobrequest->validated());

        $job->slug;

        $job->jobcategory()->associate($jobrequest->input('category'));

        $job->joblevel()->associate($jobrequest->input('level'));

        $job->currency()->associate($jobrequest->input('currency'));

        $job->country()->associate($jobrequest->input('countries'));

        $job->state()->associate($jobrequest->input('states'));

        $job->city()->associate($jobrequest->input('cities'));

        if ($jobrequest->hasFile('photo')) {
            $photo = $jobrequest->file('photo');
            $imageName = uniqid() . '_' . $photo->getClientOriginalName();

            if ($photo->isValid() && strpos($photo->getMimeType(), 'image/') !== false) {
                $photo->move(public_path('images/jobs/main-photo'), $imageName);
                $job->main_image_path = $imageName;
            } else {
                session()->flash('status', 'Nieprawidłowe zdjęcie');
            }
        }

        $job->save();

        $job->jobtype()->sync($jobrequest->input('type'));

        $job->language()->sync($jobrequest->input('language'));

        $job->skill()->sync($jobrequest->input('skills'));

        $job->photos()->sync($jobrequest->input('photos'));

        $job->jobstate()->sync($jobrequest->input('jobstate'));

        if ($jobrequest->hasFile('photos')) {
            foreach ($jobrequest->file('photos') as $photo) {
                $imageName = time() . '_' . $photo->getClientOriginalName();
                $photo->move(public_path('images/jobs/photos'), $imageName);

                $newPhoto = new Photo();
                $newPhoto->photo = $imageName;
                $newPhoto->save();

                $job->photos()->attach($newPhoto->id);
            }
        }

        if ($job->save($jobrequest->validated())) {
            session()->flash('status', ('Twoja oferta pracy został pomyślnie zmieniona'));
        } else {
            session()->flash('status', ('Coś poszło nie tak :('));
        }

        return redirect()->route('jobs.show',['job' => $job]);
    }


    public function show(Job $job)
    {

        $jobCategory = $job->jobcategory;
        $jobSimilarCategorys = Job::where('jobcategory_id', $jobCategory->id)
            ->where('id', '!=', $job->id)
            ->get();
        return view('jobs.show', [
            'job' => $job,
            'jobSimilarCategorys' => $jobSimilarCategorys,
        ]);
    }


    public function edit(Job $job)
    {

        $hasExistingPhoto = !empty($job->main_image_path);
        $hasExistingPhotos = $job->photos()->exists();

        $sexOptions = ['Mężczyzna', 'Kobieta', 'Inne'];
        $jobCategories = JobCategory::all();
        $joblevels = JobLevel::all();
        $jobtypes = JobType::all();
        $jobcurrencies = Currency::all();
        $languages = Language::all();
        $photos = Photo::all();
        $skills = Skill::all();
        $expiry = Carbon::now()->addDays(30)->format('Y-m-d');
        $countries = Country::get(["country", "id"]);
        $jobstate = JobState::all();

        $data = [
            'job' => [
                'sexOptions' => $sexOptions,
                'jobcategories' => $jobCategories,
                'joblevels' => $joblevels,
                'jobtypes' => $jobtypes,
                'jobcurrencies' => $jobcurrencies,
                'joblanguages' => $languages,
                'jobskills' => $skills,
                'jobphotos' => $photos,
                'expiry' => $expiry,
                'jobstate' => $jobstate
            ],
            'photo' => [
                'hasExistingPhoto' => $hasExistingPhoto,
                'hasExistingPhotos' => $hasExistingPhotos,
            ],
            'countries' => $countries
        ];

        return view('jobs.edit', [
            'job' => $job,
            'data' => $data,
        ]);
    }


    public function update(JobRequest $jobrequest, Job $job)
    {
        $job->slug;

        $job->jobcategory()->associate($jobrequest->input('category'));

        $job->joblevel()->associate($jobrequest->input('level'));

        $job->currency()->associate($jobrequest->input('currency'));

        if ($jobrequest->hasFile('photo')) {
            if (!empty($job->main_image_path)) {
                $oldPath = public_path('images/jobs/main-photo/' . $job->main_image_path);
                if (file_exists($oldPath)) {
                    Storage::delete($oldPath);
                    $job->main_image_path = null;
                }
            }
            $photo = $jobrequest->file('photo');
            $imageName = uniqid() . '_' . $photo->getClientOriginalName();

            if ($photo->isValid() && strpos($photo->getMimeType(), 'image/') !== false) {
                $photo->move(public_path('images/jobs/main-photo/'), $imageName);
                $job->main_image_path = $imageName;
            } else {
                session()->flash('status', 'Nieprawidłowe zdjęcie');
            }

            if (!$jobrequest->hasFile('photo') && !empty($job->main_image_path)) {
                $job->main_image_path = $job->main_image_path;
            }
        }

        $job->jobtype()->sync($jobrequest->input('type'));

        $job->language()->sync($jobrequest->input('language'));

        $job->skill()->sync($jobrequest->input('skills'));

        $job->photos()->sync($jobrequest->input('photos'));

        if ($jobrequest->hasFile('photos')) {
            if ($job->photos()->exists()) {
                foreach ($job->photos as $photo) {
                    $oldPath = 'images/jobs/photos/' . $photo->photo;
                    if (file_exists($oldPath)) {
                        Storage::delete($oldPath);
                        $job->photos()->detach();
                    }
                }
            }
            foreach ($jobrequest->file('photos') as $photo) {
            if ($photo->isValid() && strpos($photo->getMimeType(), 'image/') !== false)
            {
                $imageName = time() . '_' . $photo->getClientOriginalName();
                $photo->move(public_path('images/jobs/photos/'), $imageName);

                $newPhoto = new Photo();
                $newPhoto->photo = $imageName;
                $newPhoto->save();

                $job->photos()->attach($newPhoto->id);
            } else {
                session()->flash('status', 'Nieprawidłowe zdjęcie');
            }
        }
    }

        if ($job->update($jobrequest->validated())) {
            session()->flash('status', ('Twoja oferta pracy został pomyślnie zmieniona'));
        } else {
            session()->flash('status', ('Coś poszło nie tak :('));
        }

        return redirect()->route('jobs.show', ['job' => $job]);
    }


    public function delete(Job $job)
    {
        if ($job->delete()) {
            session()->flash('status', 'Twoja oferta pracy została usunięta.');
        } else {
            session()->flash('status', 'Wystąpił błąd podczas usuwania Twojej oferty pracy :(');
        }

        return redirect()->route('jobs.index');
    }


    public function search(Request $request)
    {
        $jobCategories = JobCategory::all();
        $jobSkills = Skill::all();
        $joblevels = JobLevel::all();
        $jobtype = JobType::all();
        $jobCount = Job::count();
        $latestJob = Job::orderBy('created_at', 'desc')->paginate(20);
        $currentDate = Carbon::now();
        $jobstate = JobState::all();

        $yearsDifference = 0;
        $monthsDifference = 0;
        $daysDifference = 0;
        $hoursDifference = 0;
        $minutesDifference = 0;

        // Parametry wyszukiwania
        $keyword = $request->input('keyword');
        $localisation = $request->input('localisation');
        $category = $request->input('category');

        $categoryRequest = $request->input('selectcategory');
        $skillsRequest = $request->input('skill');
        $typesRequest = $request->input('type');
        $levelsRequest = $request->input('level');

        // Sortowanie
        $sortBy = $request->input('sorting');

        $query = Job::query();

        if ($sortBy == 'salary') {
            $query->orderBy('salary_from', 'asc');
        } else if ($sortBy == 'title') {
            $query->orderBy('title', 'asc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        if (!empty($categoryRequest)) {
        $query->whereIn('jobcategory_id', $categoryRequest);
        }
        if (!empty($skillsRequest)) {
        $query->whereHas('skill', function ($query) use ($skillsRequest) {
        $query->whereIn('skill', $skillsRequest);
        });
        }
        if (!empty($typesRequest)) {
        $query->whereHas('jobtype', function ($query) use ($typesRequest) {
        $query->whereIn('type', $typesRequest );
        });
        }
        if (!empty($levelsRequest)) {
        $query->whereIn('joblevel_id', $levelsRequest);
        }

        $query->when(!is_null($keyword), function ($query) use ($keyword) {
            return is_numeric($keyword) 
                ? $query->where(function ($query) use ($keyword) {
                    $query->where('salary_from', '<=', $keyword)
                        ->orWhere('salary_to', '>=', $keyword);
                }) 
                : $query->where(function ($query) use ($keyword) {
                    $query->where('title', 'like', "%$keyword%")
                        ->orWhereHas('joblevel', function ($query) use ($keyword) {
                            $query->where('level', 'like', "%$keyword%");
                        })
                        ->orWhereHas('skill', function ($query) use ($keyword) {
                            $query->where('skill', 'like', "%$keyword%");
                        })
                        ->orWhereHas('jobtype', function ($query) use ($keyword){
                            $query->where('type', 'like', "%$keyword%");
                        });
                });
        })
        ->when(!is_null($category), function ($query) use ($category) {
            return $query->whereHas('jobcategory', function ($query) use ($category) {
                $query->where('category', 'like', "%$category%");
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
        
        $jobSearchs = $query->paginate(12);

        foreach ($jobSearchs as $job) {
        $createdAt = $job->created_at;
        $diff = $currentDate->diff($createdAt);

        $yearsDifference = $diff->y;
        $monthsDifference = $diff->m;
        $daysDifference = $diff->d;
        $hoursDifference = $diff->h;
        $minutesDifference = $diff->i;
}

        $data = [
            'jobs' => [
                'jobCategories' => $jobCategories,
                'jobstate' => $jobstate,
                'jobSkills' => $jobSkills,
                'joblevels' => $joblevels,
                'jobtype' => $jobtype,
                'jobCount' => $jobCount,
                'latestJob' => $latestJob,
            ],
            'date' => [
                'yearsDifference' => $yearsDifference,
                'monthsDifference' => $monthsDifference,
                'daysDifference' => $daysDifference,
                'hoursDifference' => $hoursDifference,
                'minutesDifference' => $minutesDifference,
            ],
        ];

        return view('jobs.search', isset($jobSearchs) ? ['jobSearchs' => $jobSearchs, 
        'data' => $data] : []);
    }
}
