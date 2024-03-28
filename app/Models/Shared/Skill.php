<?php

namespace App\Models\Shared;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Job;

class Skill extends Model
{
    /**
     * @property int $id
     * @property string $skill
     * Word, Programming, make Server etc.
     */

    protected $table = 'skills';

    protected $fillable = [
        'skill'
    ];

    protected $casts = [
        'skill' => 'string',
    ];

    /**
     * Get jobs associated with the skills.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function jobs()
    {
        return $this->belongsToMany(Job::class, 'skill_job', 'skill_id', 'job_id');
    }

    use HasFactory;
}
