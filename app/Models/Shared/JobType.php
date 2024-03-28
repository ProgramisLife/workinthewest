<?php

namespace App\Models\Shared;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Job;

class JobType extends Model
{
    /**
     * @property int $id
     * @property string $type
     * Część Etatu, Kontrakt, Praktyka
     */

    protected $table = 'jobtypes';

    protected $fillable = [
        'type'
    ];

    protected $casts = [
        'type' => 'string',
    ];

    /**
     * Get jobs associated with the job type.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function jobs()
    {
        return $this->belongsToMany(Job::class, 'jobtype_job', 'jobtype_id', 'job_id');
    }
    use HasFactory;
}
