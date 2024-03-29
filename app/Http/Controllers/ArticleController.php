<?php

namespace App\Http\Controllers;

use App\Http\Requests\Article\ArticleRequest;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    const JOBS_PER_PAGE = 10;
    /**
     * Show all articles.
     *
     * @return void
     */
    public function index()
    {
        $newestArticle = Article::orderBy('created_at', 'DESC')->paginate(self::JOBS_PER_PAGE);

        return view('articles.index');
    }

    /**
     * Show add job form.
     *
     * @return void
     */
    public function add()
    {
        return view('articles.add');
    }

    /**
     * Store new job.
     *
     * @return void
     */
    public function store(ArticleRequest $articlerequest)
    {
        $article = new Article($articlerequest->validated());
        $article->slug;

        // Zapisz główne zdjęcie
        if ($articlerequest->hasFile('photo')) {
            $photo = $articlerequest->file('photo');
            $imageName = uniqid() . '_' . $photo->getClientOriginalName();

            if ($photo->isValid() && strpos($photo->getMimeType(), 'image/') !== false) {
                $photo->move(public_path('images/article/main-photo'), $article->id . $imageName);
                $article->main_image_path = $imageName;
            } else {
                session()->flash('status', 'Nie prawidłowe zdjęcie');
            }
        }

        //$article->owner()->associate($articlerequest->input('owner_id'));

        $article->save();

        return redirect(
            route(
                'articles.show',
                ['article' => $article]
            )
        );
    }


    /**
     * Show single job details.
     *
     * @param Job $job
     * @return void
     */
    public function show(Article $article)
    {
        return view('articles.show', ['article' => $article]);
    }

    /**
     * Show edit job form.
     *
     * @param Job $job
     * @return void
     */
    public function edit(Article $article)
    {
        return view('articles.edit', [
            'article' => $article
        ]);
    }

    /**
     * Update job.
     *
     * @param Job $job
     * @return void
     */
    public function update(Request $request, Article $article)
    {
        return "Update job";
    }

    /**
     * Delete job.
     *
     * @param Job $job
     * @return void
     */
    public function delete(Request $request, Article $article)
    {
        return 'delete job';
    }

    /**
     * Search job.
     *
     * @param Job $job
     * @return void
     */
    public function search(Request $request, Article $article)
    {
        return 'search';
    }
}
