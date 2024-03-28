<?php

namespace App\Observers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Models\Job;
use App\Jobs\CreateUniqueSlug;

class JobObserver
{
    public function creating(Job $job)
    {
        CreateUniqueSlug::dispatch($job);
    }

    public function updating(Job $job)
    {
        CreateUniqueSlug::dispatch($job);
    }
}
