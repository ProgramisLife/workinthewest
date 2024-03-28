<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    /**
     * 
     * Article Model
     * 
     * @property int $id
     * @property int $ownerid
     * @property string $imagepath
     * @property string $title (min:3|max:255)
     * @property text $description
     * @property string $slug   (max:255|unique)
     * @property string $source
     * @property string $youtube
     * @property string $facebook
     * @property string $vimeo
     * @property string $x
     * @property string $linkedin
     */

    protected $atributes = [
        'description' => '',
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

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    use HasFactory;
}
