<?php
declare(strict_types=1);

namespace App;


use Illuminate\Http\UploadedFile;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $avatar_file;

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function setAvatarImage(UploadedFile $image)
    {
        $this->avatar_file = $image;
        $this->attributes['avatar'] = $image->getClientOriginalExtension();
    }

    public function saveAvatar()
    {
        $this->avatar_file->move(config('site.users.avatar.path'), "{$this->name}.{$this->avatar}");
    }

    public function isAdmin(): bool
    {
        return $this->role === 'ROLE_ADMIN';
    }
    public function isBanned(): bool
    {
        return $this->role === 'ROLE_BANNED';
    }
}
