<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use Illuminate\Support\Str;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Models\Job;
use App\Models\Shared\JobCategory;
use App\Models\Shared\Photo;
use App\Models\Shared\Localisation\Country;
use App\Models\Shared\Localisation\State;
use App\Models\Shared\Localisation\City;

class Employer extends User
{
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['name', 'id']
            ]
        ];
    }
    use Sluggable;
    /**
     * 
     * Pracodawca Model
     * 
     * @property int $id
     * @property string $main_imagepath
     * @property string $featured_imagepath
     * @property string $background_imagepath
     * @property string $name (min:3|max:255) nazwafirmy
     * @property string $header
     * @property text $description
     * @property string $slug   (max:255|unique)
     * @property string $email
     * @property string $phone
     * @property string $companywebsite
     * @property date $creation_date
     * @property enum $company_size {large, medium, small, micro}
     * @property bool $featured
     */

    

    /**
     * Social
     * @property string $facebook
     * @property string $twitter
     * @property string $youtube
     * @property string $vimeo
     * @property string $linkedin
     */

     /**
      * Galeria
      */

      /**
       * Branża
       * Administracja, Badania i rozwój i tak dalej.
       */

     /**
     * Lokalizacja
     * @property int $country_id
     * @property int $state_id
     * @property int $city_id
     */

    protected $table = 'employer';

    protected $atributes = [
        'description' => '',
        'bool' => 'false',
    ];

    protected $fillable = [
        'main_imagepath', 'featured_imagepath', 'background_imagepath', 'name',
        'header', 'description', 'slug', 'email', 'phone', 'companywebsite', 'creation_date',
        'company_size', 'featured', 'facebook', 'twitter', 'youtube', 'vimeo', 'linkedin',
        'country_id', 'state_id', 'city_id'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get pracodawca jobcategories relation.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function jobcategory()
    {
        return $this->belongsToMany(JobCategory::class, 'employer_category', 'employer_id', 'jobcategory_id');
    }

    /**
     * Get pracodawca jobcategories relation.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function photos()
    {
        return $this->belongsToMany(Photo::class, 'employer_photo', 'employer_id', 'photo_id');
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

    public function jobs()
    {
        return $this->hasMany(Job::class, 'owner_id', 'id')
            ->orderBy('updated_at', 'DESC');
    }

    use HasFactory;
}