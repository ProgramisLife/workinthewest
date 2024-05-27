<?php

namespace App\Models\Shared;

use App\Models\Users\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    /**
     * @property intiger $id
     * @property string $title
     * @property string $companyname
     * @property date $startdate
     * @property date $enddate
     * @property string $description
     */

    protected $table = 'experiences';

    protected $fillable = [
        'id', 'title', 'companyname', 'startdate', 'enddate', 'description'
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
        return $this->hasMany(Employee::class, 'experience_id', 'id');
    }

    use HasFactory;
}
