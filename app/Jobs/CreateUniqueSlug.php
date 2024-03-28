<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;
use App\Models\Job;

class CreateUniqueSlug implements ShouldQueue
{
    use Dispatchable, SerializesModels;

    protected $job;

    /**
     * Create a new job instance.
     */
    public function __construct(Job $job)
    {
        $this->job = $job;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $slug = $this->getCurrentJobSlug();
        $releatedJobs = $this->getRelatedJobs($slug);

        $releatedJobExist = $releatedJobs->contains(Job::where('slug', $slug)->first());

        if ($releatedJobExist) {
            $slug = "$slug-{$releatedJobs->count()}";
        }

        $this->job->slug = $slug;
    }

    protected function getCurrentJobSlug()
    {
        return Str::slug($this->job->title);
    }

    protected function getRelatedJobs(string $slug)
    {
        return Job::where('slug', 'LIKE', "$slug%")
            ->where('id', '<>', $this->job->id)
            ->get();
    }
}
