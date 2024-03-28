<?php

namespace App\Models\Shared;

use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * @property int $id
     * @property string $name
     */
    protected $table = 'tags';

    protected $fillable = [
        'name'
    ];

    protected $casts = [
        'name' => 'string',
    ];

    /**
     * Get jobs associated with the tags.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function jobs()
    {
        return $this->belongsToMany(Job::class, 'tag_job', 'tag_id', 'job_id');
    }

    public function getDisplayName()
    {
        return implode(' ', array_map('ucfirst', explode(' ', $this->name)));
    }

    use HasFactory;
}
