<?php

namespace App\Models\Shared;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Job;

class Photo extends Model
{
    /**
     * @property int $id
     * @property string $photo
     */

    protected $table = 'photos';

    protected $fillable = [
        'photo'
    ];

    protected $casts = [
        'photo' => 'string',
    ];
    /**
     * Get jobs associated with the photos.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function jobs()
    {
        return $this->belongsToMany(Job::class, 'photo_job', 'photo_id', 'job_id');
    }
    use HasFactory;
}
