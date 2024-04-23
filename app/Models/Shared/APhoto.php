<?php

namespace App\Models\Shared;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Accommodation;

class APhoto extends Model
{
    /**
     * @property int $id
     * @property string $photo
     */

    protected $table = 'aphoto';

    protected $fillable = [
        'photo'
    ];

    protected $casts = [
        'photo' => 'string',
    ];
    /**
     * Get jobs associated with the photos.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function accommodation()
    {
        return $this->belongsToMany(Accommodation::class, 'accommodation_photo', 'aphoto_id', 'accommodation_id');
    }

    public function delete()
    {
        $oldPath = public_path('images/accommodation/photos/' . $this->photo);
        if (file_exists($oldPath)) {
            unlink($oldPath);
        }
        return parent::delete();
    }

    use HasFactory;
}
