<?php

namespace App\Models\Shared;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Job;

class JobLevel extends Model
{
    /**
     * @property int $id
     * @property string $level
     * Asystent, Dyrektor, Kierownik, Pracownik, Stażysta, Praktykatn, Specjalista
     */

    protected $table = 'joblevels';

    protected $fillable = [
        'level'
    ];

    protected $casts = [
        'level' => 'string',
    ];

    /**
     * Get jobs associated with the job level.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function jobs()
    {
        return $this->hasMany(Job::class, 'joblevel_id', 'id');
    }
    use HasFactory;
}
