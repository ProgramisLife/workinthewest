<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Article;

class Moderator extends User
{

    public function articles()
    {
        return $this->hasMany(Article::class, 'owner_id', 'id')
            ->orderBy('updated_at', 'DESC');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    use HasFactory;
}
