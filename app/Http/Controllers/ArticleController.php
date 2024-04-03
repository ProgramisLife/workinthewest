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

        $files = ['job.png', 'job2.jpg'];

        return view('articles.index', ['articles' => $newestArticle, 'files' => $files]);
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

        return redirect()->route('articles.show', ['article' => $article]);
    }

    public function show(Article $article)
    {
        return view('articles.show', ['article' => $article]);
    }

    public function edit(Article $article)
    {
        return view('articles.edit', ['article' => $article]);
    }

    public function update(Article $article)
    {
        return redirect()->route('articles.show', ['article' => $article]);
    }

    public function delete(Article $article)
    {
        if ($article->delete()) {
            session()->flash('status', 'Artykuł został usunięty.');
        } else {
            session()->flash('status', 'Wystąpił błąd podczas usuwania artykułu :(');
        }

        return redirect()->route('articles.index');
    }
}
