<?php

namespace App\Http\Controllers;

use App\Http\Requests\Article\ArticleRequest;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Share;

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

        $data = [
            'label' => [
                'top' => [
                    'top-header' => 'artykuły',
                    'top-input-keyword' => 'Słowo kluczowe?',
                    'top-search' => 'Wyszukaj',
                ],
            ],
    ];

        return view('articles.index', [
            'articles' => $newestArticle,
            'files' => $files,
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
        $shareButtons = Share::page( url('/articles.show'),
        $article->title)
        ->facebook()
        ->twitter()
        ->linkedin()
        ->whatsapp();

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
            'shareButtons' => $shareButtons,
        ]);
    }

    public function edit(Article $article)
    {
        return view('articles.edit', ['article' => $article]);
    }

    public function update(ArticleRequest $articlerequest, Article $article)
    {
        $article->slug;

        if ($articlerequest->hasFile('photo')) {
            if (!empty($article->main_image_path)) {
                $oldPath = public_path('images/article/main-photo/' . $article->main_image_path);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                    $article->main_image_path = null;
                }
            }
            $photo = $articlerequest->file('photo');
            $imageName = uniqid() . '_' . $photo->getClientOriginalName();

            if ($photo->isValid() && strpos($photo->getMimeType(), 'image/') !== false) {
                $photo->move(public_path('images/article/main-photo/'), $imageName);
                $article->main_image_path = $imageName;
            } else {
                session()->flash('status', 'Nieprawidłowe zdjęcie');
            }

            if (!$articlerequest->hasFile('photo') && !empty($article->main_image_path)) {
                $article->main_image_path = $article->main_image_path;
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

        $keyword = $request->input('keyword');

        $query = Article::query();

        $query->when(!is_null($keyword), function ($query) use ($keyword) {
        return is_numeric($keyword) 
        ? $query->where(function ($query) use ($keyword) {
            $query->where('created_at', 'like', "%$keyword%")
            ->orwhere('updated_at', 'like', "%$keyword%");
        }) 
        : $query->where(function ($query) use ($keyword) {
            $query->where('title', 'like', "%$keyword%")
                ->orWhere('slug', 'like', "%$keyword%")
                ->orWhere('youtube', 'like', "%$keyword%")
                ->orWhere('source', 'like', "%$keyword%");
                });
        });

        $data = [
            'label' => [
                'top' => [
                    'top-header' => 'artykuły',
                    'top-input-keyword' => 'Słowo kluczowe?',
                    'top-search' => 'Wyszukaj',
                ],
                'empty' => 'Nie znaleziono artykułu'
        ]
    ];

        $articles = $query->paginate(20);

        return view('articles.index', isset($articles) ? ['articles' => $articles, 
        'data' => $data] : []);
    }
}
