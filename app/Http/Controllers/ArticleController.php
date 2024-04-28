<?php

namespace App\Http\Controllers;

use App\Http\Requests\Article\ArticleRequest;
use App\Models\Article;
use Illuminate\Support\Facades\Request;

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

        return view('articles.index', [
            'articles' => $newestArticle,
            'files' => $files
        ]);
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

        if ($articlerequest->hasFile('photo')) {
            $photo = $articlerequest->file('photo');
            $imageName = uniqid() . '_' . $photo->getClientOriginalName();

            // Przesuń nowe zdjęcie do folderu i zaktualizuj ścieżkę do zdjęcia w bazie danych
            if ($photo->isValid() && strpos($photo->getMimeType(), 'image/') !== false) {
                $photo->move(public_path('images/article/main-photo'), $imageName);
                $article->main_image_path = $imageName;
            } else {
                session()->flash('status', 'Nieprawidłowe zdjęcie');
            }
        }


        //$article->owner()->associate($articlerequest->input('owner_id'));

        $article->save();

        return redirect()->route('articles.show', ['article' => $article]);
    }

    public function show(Article $article)
    {
        $files = ['job.png', 'job2.jpg'];
        $newestArticle = Article::orderBy('created_at', 'DESC')->paginate(self::JOBS_PER_PAGE);
        $nextArticle = Article::where('id', '>', $article->id)->orderBy('id')->first();
        $previousArticle = Article::where('id', '<', $article->id)->orderBy('id')->first();

        return view('articles.show', [
            'article' => $article,
            'nextArticle' => $nextArticle,
            'previousArticle' => $previousArticle,
            'articles' => $newestArticle,
            'files' => $files,
        ]);
    }

    public function edit(Article $article)
    {
        return view('articles.edit', ['article' => $article]);
    }

    public function update(ArticleRequest $articlerequest, Article $article)
    {
        $article->slug;

        if (!empty($article->main_image_path)) {
            $oldPath = public_path('images/article/main-photo/' . $article->main_image_path);
            if (file_exists($oldPath)) {
                unlink($oldPath);
                $article->main_image_path = null;
            }
        }

        if ($articlerequest->hasFile('photo')) {
            $photo = $articlerequest->file('photo');
            $imageName = uniqid() . '_' . $photo->getClientOriginalName();

            // Przesuń nowe zdjęcie do folderu i zaktualizuj ścieżkę do zdjęcia w bazie danych
            if ($photo->isValid() && strpos($photo->getMimeType(), 'image/') !== false) {
                $photo->move(public_path('images/article/main-photo'), $imageName);
                $article->main_image_path = $imageName;
            } else {
                session()->flash('status', 'Nieprawidłowe zdjęcie');
            }
        }


        if ($article->update($articlerequest->validated())) {
            session()->flash('status', ('Twój artykuł został pomyślnie zmieniony'));
        } else {
            session()->flash('status', ('Coś poszło nie tak :('));
        }

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

    public function search(Request $request)
    {
        return dd('coś');
    }
}
