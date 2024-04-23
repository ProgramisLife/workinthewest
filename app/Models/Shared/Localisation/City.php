<?php

namespace App\Models\Shared\Localisation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shared\Localisation\Country;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    /**
     * @property int $id
     * @property string $city
     * @property string $postal_code
     * @property double $longitude długość
     * @property double $latitude szerokość
     * @property string $country_id
     * @property string $state_id
     */

    use SoftDeletes;

    protected $table = 'cities';

    protected $fillable = [
        'id', 'city', 'postal_code', 'longitude', 'latitude', 'state_id'
    ];

    protected $casts = [
        'city' => 'string',
        'postal_code' => 'string',
        'longitude' => 'double',
        'latitude' => 'double',
        'state_id' => 'integer',
    ];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    use HasFactory;
}
