<?php

namespace App\Models\Users;

use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Article;

class Editor extends User
{
    use HasApiTokens, Notifiable, MustVerifyEmail, HasFactory;

    /**
     * Redaktor model
     * @property int $id;
     * @property string $email;
     * @property string $name;
     * @property string $password;
     * @property bool $banned
     */

    protected $table = 'editors';

    protected $fillable = [
        'email', 'name', 'password', 'featured', 'banned'
    ];

    protected $atributes = [
        'description' => '',
        'featured' => 'false',
        'banned' => 'false',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function articles()
    {
        return $this->hasMany(Article::class, 'owner_id', 'id')
            ->orderBy('updated_at', 'DESC');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
