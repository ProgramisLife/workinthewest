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
use Exception;

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


        $data = [
            'jobs' => [
                'newJobs' => $newJobs,
                'featuredJobs' => $featuredJobs,
            ],
            'label' => [
                'cooperation' => 'współpracujemy:',
                'empty' => 'Brak ofert pracy',
                'news' => 'Centrum Aktualności',
                'news-content' => 'Tutaj możesz śledzić najnowsze newsy z świata pracy.',
                'articles' => 'Brak artykułów do wyświetlenia.',
            ],
            'categories' => $jobCategories,
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
        $sexOptions = ['Mężczyzna', 'Kobieta', 'Inne'];

        $jobCategories = JobCategory::all();
        $joblevels = JobLevel::all();
        $jobtypes = JobType::all();
        $jobcurrencies = Currency::all();
        $languages = Language::all();
        $photos = Photo::all();
        $skills = Skill::all();
        $expiry = Carbon::now()->addDays(30)->format('Y-m-d');
        return view('jobs.add', [
            'sexOptions' => $sexOptions,
            'jobcategories' => $jobCategories,
            'joblevels' => $joblevels,
            'jobtypes' => $jobtypes,
            'jobcurrencies' => $jobcurrencies,
            'joblanguages' => $languages,
            'jobskills' => $skills,
            'jobphotos' => $photos,
            'expiry' => $expiry,
        ]);
    }


    public function store(JobRequest $jobrequest)
    {
        $job = new Job($jobrequest->validated());
        $job->slug;

        // Zapisz główne zdjęcie
        if ($jobrequest->hasFile('photo')) {
            $photo = $jobrequest->file('photo');
            $imageName = uniqid() . '_' . $photo->getClientOriginalName();

            if ($photo->isValid() && strpos($photo->getMimeType(), 'image/') !== false) {
                $photo->move(public_path('images/jobs/main-photo'), $job->id . $imageName);
                $job->main_image_path = $imageName;
            } else {
                session()->flash('status', 'Nie prawidłowe zdjęcie');
            }
        }

        // Powiąż kategorię pracy
        $job->jobcategory()->associate($jobrequest->input('category'));

        // Powiąż poziom pracy
        $job->joblevel()->associate($jobrequest->input('level'));

        // Powiąż walutę
        $job->currency()->associate($jobrequest->input('currency'));

        $job->save();

        // Zapisz dodatkowe zdjęcia
        if ($jobrequest->hasFile('photos')) {
            foreach ($jobrequest->file('photos') as $photo) {
                $imageName = time() . '_' . $photo->getClientOriginalName();
                $photo->move(public_path('images/jobs/photos'), $imageName);

                // Stwórz nowy obiekt Photo i zapisz nazwę zdjęcia
                $newPhoto = new Photo();
                $newPhoto->photo = $imageName;
                $newPhoto->save(); // Najpierw zapisz nowe zdjęcie

                // Dołącz dodatkowe zdjęcie do modelu Job poprzez relację wiele do wielu
                $job->photos()->attach($newPhoto->id);
            }
        }

        // Synchronizuj typy pracy
        $job->jobtype()->sync($jobrequest->input('type'));

        // Synchronizuj języki
        $job->language()->sync($jobrequest->input('language'));

        // Synchronizuj umiejętności
        $job->skill()->sync($jobrequest->input('skills'));

        // // Synchronizuj dodatkowe zdjęcia
        // $job->photos()->sync($jobrequest->input('photos', []));

        return redirect(
            route(
                'jobs.show',
                ['job' => $job]
            )
        );
    }


    public function show(Job $job)
    {
        return view('jobs.show', ['job' => $job]);
    }


    public function edit(Job $job)
    {
        $sexOptions = ['Mężczyzna', 'Kobieta', 'Inne'];

        $jobCategories = JobCategory::all();
        $joblevels = JobLevel::all();
        $jobtypes = JobType::all();
        $jobcurrencies = Currency::all();
        $languages = Language::all();
        $photos = Photo::all();
        $skills = Skill::all();
        $expiry = Carbon::now()->addDays(30)->format('Y-m-d');
        return view('jobs.edit', [
            'job' => $job,
            'sexOptions' => $sexOptions,
            'jobcategories' => $jobCategories,
            'joblevels' => $joblevels,
            'jobtypes' => $jobtypes,
            'jobcurrencies' => $jobcurrencies,
            'joblanguages' => $languages,
            'jobskills' => $skills,
            'jobphotos' => $photos,
            'expiry' => $expiry,
        ]);
    }


    public function update(JobRequest $jobrequest, Job $job)
    {
        // Powiąż kategorię pracy
        $job->jobcategory()->associate($jobrequest->input('category'));

        // Powiąż poziom pracy
        $job->joblevel()->associate($jobrequest->input('level'));

        // Powiąż walutę
        $job->currency()->associate($jobrequest->input('currency'));

        // Synchronizuj typy pracy
        $job->jobtype()->sync($jobrequest->input('type'));

        // Synchronizuj języki
        $job->language()->sync($jobrequest->input('language'));

        // Synchronizuj umiejętności
        $job->skill()->sync($jobrequest->input('skills'));

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
        // Parametry wyszukiwania
        $keyword = $request->input('keyword');
        $localisation = $request->input('localisation');
        $category = $request->input('category');

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

        $query->when(!is_null($keyword), function ($query) use ($keyword) {
            return is_numeric($keyword) ? $query->where(function ($query) use ($keyword) {
                $query->where('salary_from', '<=', $keyword)
                    ->orWhere('salary_to', '>=', $keyword);
            }) : $query->where(function ($query) use ($keyword) {
                $query->where('title', 'like', "%$keyword%")
                    ->orWhereHas('joblevel', function ($query) use ($keyword) {
                        $query->where('level', 'like', "%$keyword%");
                    })
                    ->orWhereHas('skill', function ($query) use ($keyword) {
                        $query->where('skill', 'like', "%$keyword%");
                    });
            });
        })->when(!is_null($category), function ($query) use ($category) {
            return $query->whereHas('jobcategory', function ($query) use ($category) {
                $query->where('category', 'like', "%$category%");
            });
        });


        // Wyszukiwanie po lokalizacji
        // else if (!is_null($localisation)) {
        //     $results = Job::whereHas('localization', function ($query) use ($localisation) {
        //         $query->where('lokalization', 'like', "%$localisation%");
        //     })->get();
        // }

        $jobSearchs = $query->paginate(20);

        return view('jobs.search', isset($jobSearchs) ? ['jobSearchs' => $jobSearchs] : []);
    }
}
