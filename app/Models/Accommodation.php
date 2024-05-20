<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shared\APhoto;
use App\Models\Shared\AccommodationCategory;
use App\Models\Shared\Currency;
use App\Models\Shared\Localisation\Country;
use App\Models\Shared\Localisation\City;
use App\Models\Shared\Localisation\State;
use Cviebrock\EloquentSluggable\Sluggable;

class Accommodation extends Model
{
    use Sluggable;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * 
     * Accommodation Model
     * 
     * @property int $id
     * @property int $ownerid
     * @property string $mainimagepath
     * @property string $title (min:3|max:255) tytuł
     * @property text $description
     * @property string $email
     * @property string $phone-number
     * @property int $price_buy
     * @property int $price_rent
     * @property string $slug   (max:255|unique)
     * @property bool $featured {Czy jest wyróżnione: Tak Nie}
     * @property string $contact {Osoba kontaktowa / Nazwa firmy} required
     */

    /**
     * Date Job Model
     * @property date $expiry {Data wygaśnięcia ogłoszenia: Ogłoszenie nie aktualne}
     */
    protected $table = 'accommodation';

    /**
     * Fillable attributes.
     */
    protected $fillable = [
        'owner_id', 'main_image_path', 'email', 'title', 'description',
        'price_buy', 'price_rent', 'slug', 'featured', 'sold',
        'phone_number', 'contact', 'expiry',
        'city_id', 'state_id', 'country_id'
    ];

    /**
     * Atributes default values.
     */
    protected $attributes = [
        'featured' => false,
        'description' => '',
    ];

    /**
     * Atributes 
     */
    protected $casts = [
        'title' => 'string',
        'featured' => 'boolean',
        '$phone_number' => 'string',
        'featured' => 'boolean',
    ];

    /**
     * Get accommodation photos relation.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function photos()
    {
        return $this->belongsToMany(APhoto::class, 'accommodation_photo', 'accommodation_id', 'aphoto_id');
    }

    public function accommodationcategory()
    {
        return $this->belongsToMany(AccommodationCategory::class, 'accommodation_category', 'accommodation_id', 'acategory_id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currencies_id', 'id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    use HasFactory;
}
