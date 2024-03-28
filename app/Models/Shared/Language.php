<?php

namespace App\Models\Shared;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Job;

class Language extends Model
{
    /**
     * @property int $id
     * @property string $language
     * Polski, Francuski, Niemiecki
     */

    protected $table = 'languages';

    protected $fillable = [
        'language'
    ];

    protected $casts = [
        'language' => 'string',
    ];

    /**
     * Get jobs associated with the languages.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\belongToMany
     */
    public function jobs()
    {
        return $this->belongsToMany(Job::class, 'language_job', 'language_id', 'job_id');
    }
    use HasFactory;
}
