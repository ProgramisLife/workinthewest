<?php

namespace App\Jobs;

use App\Models\Article;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class CreateArticleSlug implements ShouldQueue
{
    use Dispatchable, SerializesModels;

    protected $article;

    /**
     * Create a new job instance.
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $slug = $this->getCurrentArticleSlug();
        $releatedArticles = $this->getRelatedArticles($slug);

        $releatedArticleExist = $releatedArticles->contains(Article::where('slug', $slug)->first());

        if ($releatedArticleExist) {
            $slug = "$slug-{$releatedArticles->count()}";
        }

        $this->article->slug = $slug;
    }

    protected function getCurrentArticleSlug()
    {
        return Str::slug($this->article->title);
    }

    protected function getRelatedArticles(string $slug)
    {
        return Article::where('slug', 'LIKE', "$slug%")
            ->where('id', '<>', $this->article->id)
            ->get();
    }
}
