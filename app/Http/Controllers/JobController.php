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
        $newJobs = Job::orderBy('created_at', 'DESC')->paginate(self::JOBS_PER_PAGE);

        $featuredJobs = Job::where('featured', true)->paginate(self::JOBS_PER_PAGE);

        $newArticles = Article::orderBy('created_at', 'DESC')->paginate(self::JOBS_PER_PAGE);

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
            ]
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

    /**
     * Store new job.
     *
     * @return void
     */
    public function store(JobRequest $jobrequest)
    {
        $job = new Job($jobrequest->validated());
        $job->slug;

        // // Zapisz główne zdjęcie
        // if ($jobrequest->hasFile('photo')) {
        //     $imageName = time() . '.' . $jobrequest->photo->extension();
        //     $jobrequest->photo->move(public_path('image'), $imageName);
        //     $job->main_image_path = $imageName;
        // }


        // // Zapisz dodatkowe zdjęcia
        // if ($jobrequest->hasFile('photos')) {
        //     foreach ($jobrequest->file('photos') as $photo) {
        //         $imageName = time() . '_' . $photo->getClientOriginalName();
        //         $photo->move(public_path() . '/images/', $job->id . $imageName);

        //         // Stwórz nowy obiekt Photo i zapisz nazwę zdjęcia
        //         $newPhoto = new Photo();
        //         $newPhoto->image_path = $imageName;

        //         $newPhoto->save();

        //         // Dołącz dodatkowe zdjęcie do modelu Job poprzez relację wiele do wielu
        //         $job->photos()->attach($newPhoto->id);
        //     }
        // }

        // Powiąż kategorię pracy
        $job->jobcategory()->associate($jobrequest->input('category'));

        // Powiąż poziom pracy
        $job->joblevel()->associate($jobrequest->input('level'));

        // Powiąż walutę
        $job->currency()->associate($jobrequest->input('currency'));

        $job->save();

        // Synchronizuj typy pracy
        $job->jobtype()->sync($jobrequest->input('type'));

        // Synchronizuj języki
        $job->language()->sync($jobrequest->input('language'));

        // Synchronizuj umiejętności
        $job->skill()->sync($jobrequest->input('skills'));

        // Synchronizuj dodatkowe zdjęcia
        $job->photos()->sync($jobrequest->input('photos', []));

        return redirect(
            route(
                'jobs.show',
                ['job' => $job]
            )
        );
    }

    /**
     * Show single job details.
     *
     * @param Job $job
     * @return void
     */
    public function show(Job $job)
    {
        return view('jobs.show', ['job' => $job]);
    }

    /**
     * Show edit job form.
     *
     * @param Job $job
     * @return void
     */
    public function edit(Job $job)
    {
        return view('jobs.edit', [
            'job' => $job
        ]);
    }

    /**
     * Update job.
     *
     * @param Job $job
     * @return void
     */
    public function update(JobRequest $request, Job $job)
    {
        return "Update job";
    }

    /**
     * Delete job.
     *
     * @param Job $job
     * @return void
     */
    public function delete(JobRequest $request, Job $job)
    {
        return 'delete job';
    }

    /**
     * Search job.
     *
     * @param Job $job
     * @return void
     */
    public function search(Request $request, Job $job)
    {
        return 'search';
    }
}
