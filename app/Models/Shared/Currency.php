<?php

namespace App\Models\Shared;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Job;

class Currency extends Model
{
    /**
     * @property int $id
     * @property string $currency
     */

    protected $table = 'currencies';

    protected $fillable = [
        'currency'
    ];

    protected $casts = [
        'currency' => 'string',
    ];
    /**
     * Get jobs associated with the job category.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function jobs()
    {
        return $this->hasMany(Job::class, 'currencies_id', 'id');
    }

    use HasFactory;
}
