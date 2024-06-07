<?php

namespace App\Models;

use App\Models\Users\Editor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Cviebrock\EloquentSluggable\Sluggable;

class Article extends Model
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
     * Article Model
     * 
     * @property int $id
     * @property int $ownerid
     * @property string $imagepath
     * @property string $title (min:3|max:255)
     * @property text $description
     * @property string $slug   (max:255|unique)
     * @property string $source
     */

    protected $atributes = [
        'description' => '',
    ];

    protected $fillable = [
        'title', 'description', 'slug', 'owner_id', 'main_image_path', 'source'
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
        return $this->belongsTo(Editor::class, 'owner_id', 'id');
    }

    use HasFactory;
}
