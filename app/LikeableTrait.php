<?php
declare(strict_types=1);

namespace App;


trait LikeableTrait
{

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }


    public function addLike(User $user): Like
    {
        return $this->likes()->create([
            'user_id' => $user->id,
            'likeable_id' => $this->id,
            'likeable_type' => static::class
        ]);
    }

}
