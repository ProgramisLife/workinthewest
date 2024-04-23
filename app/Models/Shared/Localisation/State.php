<?php

namespace App\Models\Shared\Localisation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shared\Localisation\City;
use App\Models\Shared\Localisation\Country;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    /**
     * @property int $id
     * @property string $state
     */

    use SoftDeletes;

    protected $table = 'states';

    protected $fillable = [
        'id', 'state', 'country_id'
    ];

    protected $casts = [
        'state' => 'string',
        'country_id' => 'integer',
    ];

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    use HasFactory;
}
