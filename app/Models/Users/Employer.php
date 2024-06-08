<?php

namespace App\Models\Users;

use App\Models\Accommodation;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Models\Job;
use App\Models\Shared\JobCategory;
use App\Models\Shared\Photo;
use App\Models\Shared\Localisation\Country;
use App\Models\Shared\Localisation\State;
use App\Models\Shared\Localisation\City;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;

class Employer extends Authenticatable implements MustVerifyEmail
{

    use HasApiTokens, Notifiable, Sluggable, HasFactory;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['name', 'id']
            ]
        ];
    }
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
     * @property bool $banned
     */

    protected $table = 'employers';

    protected $atributes = [
        'description' => '',
        'featured' => 'false',
        'banned' => 'false',
    ];

    protected $fillable = [
        'main_imagepath', 'featured_imagepath', 'background_imagepath', 'name', 'password',
        'header', 'description', 'slug', 'email', 'phone', 'companywebsite', 'creation_date',
        'company_size', 'featured', 'facebook', 'twitter', 'youtube', 'vimeo', 'linkedin',
        'country_id', 'state_id', 'city_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
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
        return $this->belongsToMany(JobCategory::class, 'employers_category', 'employers_id', 'jobcategory_id');
    }

    /**
     * Get pracodawca jobcategories relation.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function photos()
    {
        return $this->belongsToMany(Photo::class, 'employers_photo', 'employers_id', 'photo_id');
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

    public function accommodation()
    {
        return $this->hasMany(Accommodation::class, 'owner_id', 'id')
            ->orderBy('updated_at', 'DESC');
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
}