<?php

namespace App\Models\Shared;

use App\Models\Users\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    /**
     * @property intiger $id
     * @property string $title
     * @property string $nameschool
     * @property date $startdate
     * @property date $enddate
     * @property string $description
     */

    protected $table = 'educations';

    protected $fillable = [
        'id', 'title', 'nameschool', 'startdate', 'enddate', 'description'
    ];

    /**
     * Atributes default values.
     */
    protected $attributes = [
        'description' => '',
    ];

    protected $casts = [
        'title' => 'string',
        'startdate' => 'date',
        'enddate' => 'date',
        'description' => 'string',
    ];
    /**
     * Get education associated with the employee category.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function employee()
    {
        return $this->hasMany(Employee::class, 'education_id', 'id');
    }

    use HasFactory;
}
