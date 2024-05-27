<?php

namespace App\Models\Shared;

use App\Models\Users\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prize extends Model
{
    /**
     * @property intiger $id
     * @property string $title
     * @property string $companyname
     * @property date $startdate
     * @property date $enddate
     * @property string $description
     */

    protected $table = 'prizes';

    protected $fillable = [
        'id', 'title', 'description'
    ];

    /**
     * Atributes default values.
     */
    protected $attributes = [
        'description' => '',
    ];

    protected $casts = [
        'title' => 'string',
        'description' => 'string',
    ];
    /**
     * Get education associated with the employee category.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function employee()
    {
        return $this->hasMany(Employee::class, 'prize_id', 'id');
    }

    use HasFactory;
}
