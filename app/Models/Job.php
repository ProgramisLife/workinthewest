<?php

namespace App\Models;

use App\Models\Shared\Currency;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Shared\JobCategory;
use App\Models\Shared\JobLevel;
use App\Models\Shared\JobType;
use App\Models\Shared\Language;
use App\Models\Shared\Photo;
use App\Models\Shared\Skill;
use App\Models\Shared\Tag;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;

class Job extends Model
{
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    use Sluggable;
    /**
     * 
     * Job Model
     * 
     * @property int $id
     * @property int $ownerid
     * @property string $mainimagepath
     * @property string $title (min:3|max:255) tytuł
     * @property string $email
     * @property text $description
     * @property int $salaryfrom {wynagrodzenie od kwoty np.2500}
     * @property int $salaryto {wynagrodzenie do jakiejś kwoty np. 5000}
     * @property enum $sex {male, female}
     * @property string $slug   (max:255|unique)
     * @property bool $featured {Czy jest wyróżnione: Tak Nie}
     */

    /**
     * Date Job Model
     * @property date $expiry {Data wygaśnięcia ogłoszenia: Ogłoszenie nie aktualne}
     * @property date $deadline {Ostateczny termin składania aplikacji}
     */

    /**
     * Location Job Model
     * 
     * @property string $location {Tutaj coś wymyślę narazie string}
     * 
     */

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($job) {
            $job->deadline = Carbon::createFromFormat('d-m-Y', $job->deadline)->format('Y-m-d');
        });
    }

    /**
     * Fillable attributes.
     */
    protected $fillable = [
        'title', 'email', 'description', 'salaryfrom', 'salaryto', 'sex', 'slug', 'featured',
        'expiry', 'deadline', 'owner_id', 'jobcategory_id', 'joblevel_id', 'currencies_id', 'main_image_path',
        'photo',
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
        'featured' => 'boolean',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Set model slug attribute.
     * Before setting check for similiar slugs and set unique values.
     * 
     * @param string $slug Job slug.
     * @return void
     */
    public function setSlugAttribute(string $slug)
    {
        $this->attributes['slug'] = Str::slug($slug);
    }

    /**
     * Get job jobcategories relation.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function jobcategory()
    {
        return $this->belongsTo(JobCategory::class, 'jobcategory_id', 'id');
    }

    /**
     * Get job joblevel relation.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function joblevel()
    {
        return $this->belongsTo(JobLevel::class, 'joblevel_id', 'id');
    }

    /**
     * Get job jobtype relation.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function jobtype()
    {
        return $this->belongsToMany(JobType::class, 'jobtype_job', 'job_id', 'jobtype_id');
    }

    /**
     * Get job languages relation.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function language()
    {
        return $this->belongsToMany(Language::class, 'language_job', 'job_id', 'language_id');
    }

    /**
     * Get job skills relation.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function skill()
    {
        return $this->belongsToMany(Skill::class, 'skill_job', 'job_id', 'skill_id');
    }

    /**
     * Get job tags relation.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_job',  'job_id', 'tag_id');
    }

    /**
     * Get job photos relation.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function photos()
    {
        return $this->belongsToMany(Photo::class, 'photo_job', 'job_id', 'photo_id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currencies_id', 'id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    use HasFactory;
}
