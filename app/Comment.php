<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Entry
 *
 * @property-read mixed $created_at
 * @property mixed $is_active
 * @property-read mixed $updated_at
 * @mixin \Eloquent
 */
class Comment extends Model implements Likeable
{
    // Make all fields fillable
    protected $guarded = [];
    protected $replies = [];
    protected $dateFormat = 'Y-m-d H:i:sO';

    use TimezoneAccessor;
    use LikeableTrait;

    public function commentable()
    {
        return $this->morphTo();
    }

    public function addReply(self $comment): void
    {
        $this->replies[] = $comment;
    }

    public function getReplies(): array
    {
        return $this->replies;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
