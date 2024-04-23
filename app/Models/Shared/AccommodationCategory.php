<?php

namespace App\Models\Shared;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Accommodation;

class AccommodationCategory extends Model
{
    protected $table = 'acategory';

    /**
     * Fillable attributes.
     */
    protected $fillable = [
        'id', 'name'
    ];

    /**
     * Atributes 
     */
    protected $casts = [
        'name' => 'string'
    ];
    public function accommodation()
    {
        return $this->belongsToMany(Accommodation::class, 'accommodation_category', 'accommodation_id', 'acategory_id');
    }

    use HasFactory;
}
