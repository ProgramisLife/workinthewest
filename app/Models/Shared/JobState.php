<?php

namespace App\Models\Shared;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Job;

class JobState extends Model
{
    /**
     * @property int $id
     * @property string $name
     */

    protected $table = 'jobstate';

    protected $fillable = [
        'name'
    ];

    protected $casts = [
        'name' => 'string',
    ];

    /**
     * Get jobs associated with the job level.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function jobs()
    {
        return $this->belongsToMany(Job::class, 'job_state', 'jobstate_id', 'job_id');
    }
    use HasFactory;
}
