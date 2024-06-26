<?php

namespace App\Models\Shared;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Job;
use App\Models\Users\Employer;

class JobCategory extends Model
{
    /**
     * @property int $id
     * @property string $category {Na przykład Administracja, Budownictwo, IT, Produkcja}
     */

    protected $table = 'jobcategories';

    protected $fillable = [
        'category'
    ];

    protected $casts = [
        'category' => 'string',
    ];

    /**
     * Get jobs associated with the job category.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function jobs()
    {
        return $this->hasMany(Job::class, 'jobcategory_id', 'id');
    }

    /**
     * Get pracodawca user associated with the job category.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function employer()
    {
        return $this->belongsToMany(JobCategory::class, 'employer_category', 'jobcategory_id', 'employer_id');
    }

    use HasFactory;
}
