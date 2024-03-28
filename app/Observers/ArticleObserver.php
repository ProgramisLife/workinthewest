<?php

namespace App\Observers;

use App\Jobs\CreateArticleSlug;
use App\Models\Article;

class ArticleObserver
{
    public function creating(Article $article)
    {
        CreateArticleSlug::dispatch($article);
    }

    public function updating(Article $article)
    {
        CreateArticleSlug::dispatch($article);
    }
}
