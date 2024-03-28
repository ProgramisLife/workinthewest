<?php

namespace App\Http\Controllers;

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
    public function store(Request $request)
    {

        return "store";
    }


    /**
     * Show single job details.
     *
     * @param Job $job
     * @return void
     */
    public function show(Article $article)
    {
        return view('tasks.show', ['article' => $article]);
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
