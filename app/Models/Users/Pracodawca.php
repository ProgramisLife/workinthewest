<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use Illuminate\Support\Str;
use Cviebrock\EloquentSluggable\Sluggable;

class Pracodawca extends User
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
     * @property string $imagepath
     * @property string $name (min:3|max:255) nazwafirmy
     * @property text $description
     * @property string $slug   (max:255|unique)
     * @property string $email
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

    use HasFactory;
}
