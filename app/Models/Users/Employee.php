<?php

namespace App\Models\Users;

use App\Models\Shared\Education;
use App\Models\Shared\Experience;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Models\User;
use App\Models\Shared\Photo;
use App\Models\Shared\Localisation\Country;
use App\Models\Shared\Localisation\State;
use App\Models\Shared\Localisation\City;
use App\Models\Shared\Prize;
use App\Models\Shared\Skill;

class Employee extends User
{
    use HasFactory;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['name', 'lastname', 'id']
            ]
        ];
    }

    /**
     * Pracownik model
     * 
     * @property int $id
     * @property string $name
     * @property string $lastname
     * @property string $main_imagepath
     * @property string $featured_imagepath
     * @property string $background_imagepath
     * @property text $description
     * @property string $slug   (max:255|unique)
     * @property string $email
     * @property string $phone
     * @property enum $sex {mężczyzna, kobieta, inne}
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
     * Edukacja many
     * @property string $title
     * @property string $nameschool
     * @property date $startdate
     * @property date $enddate
     * @property string $description
     */

    /**
     * Doświadczenie zawodowe many
     * @property string $title
     * @property string $companyname
     * @property date $startdate
     * @property date $enddate
     * @property string $description 
     */

    /**
     * Zbiór umiejętności
     * @property string $title
     * @property int $percentvalue 
     */

    /**
     * Nagroda many
     * @property string $title
     * @property int $year
     * @property string $description 
     */

    /**
    * Lokalizacja
    * @property int $country_id
    * @property int $state_id
    * @property int $city_id
    */

    protected $table = 'employee';

    protected $atributes = [
        'description' => '',
        'bool' => 'false',
    ];

    protected $fillable = [
        'name', 'lastname', 'main_imagepath', 'featured_imagepath', 'background_imagepath', 'password',
        'sex', 'header', 'description', 'slug', 'email', 'phone',
        'featured', 'facebook', 'twitter', 'youtube', 'vimeo', 'linkedin',
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
     * Get employee education relation.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function education()
    {
        return $this->belongsToMany(Education::class, 'education_employee', 'employee_id', 'education_id');
    }

    /**
     * Get employee experience relation.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function experience()
    {
        return $this->belongsToMany(Experience::class, 'experience_employee', 'employee_id', 'experience_id');
    }

    /**
     * Get employee skill relation.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function skill()
    {
        return $this->belongsToMany(Skill::class, 'employee_skill', 'employee_id', 'skill_id');
    }

    /**
     * Get employee prize relation.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function prize()
    {
        return $this->belongsToMany(Prize::class, 'employee_prize', 'employee_id', 'prize_id');
    }

    /**
     * Get pracodawca jobcategories relation.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function photos()
    {
        return $this->belongsToMany(Photo::class, 'employee_photo', 'employee_id', 'photo_id');
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
