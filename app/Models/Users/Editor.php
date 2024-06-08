<?php

namespace App\Models\Users;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Article;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;


class Editor extends Authenticatable  implements MustVerifyEmail
{
    use HasApiTokens, Notifiable, HasFactory;

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

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
}
