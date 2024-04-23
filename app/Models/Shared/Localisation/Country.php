<?php

namespace App\Models\Shared\Localisation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shared\Localisation\City;
use App\Models\Shared\Localisation\State;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    /**
     * @property int $id
     * @property string $country
     * @property string $shortcut
     * @property int $state_id
     */

    use SoftDeletes;

    protected $table = 'countries';

    protected $fillable = [
        'id', 'country', 'shortcut'
    ];

    protected $casts = [
        'country' => 'string',
        'shortcut' => 'string',
    ];

    public function states()
    {
        return $this->hasMany(State::class);
    }

    public function cities()
    {
        return $this->hasManyThrough(City::class, State::class);
    }

    use HasFactory;
}
