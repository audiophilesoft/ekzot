<?php
declare(strict_types=1);
namespace App;

/**
 * App\Article
 *
 * @property-read mixed $created_at
 * @property mixed $enable_comments
 * @property mixed $is_active
 * @property mixed $show_on_main
 * @property-read mixed $updated_at
 * @mixin \Eloquent
 */
class Article extends Entry implements Commentable
{
    use CommentableTrait;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function catalogue()
    {
        return $this->belongsTo(Catalogue::class);
    }

    public function getFillable(): array
    {
        return array_merge(
            parent::getFillable(),
            ['description', 'enable_comments', 'rank', 'show_on_main']
        );
    }

    public function setEnableCommentsAttribute($value)
    {
        $this->attributes['enable_comments'] = (bool)$value;
    }


    public function getEnableCommentsAttribute(?bool $value): ?bool
    {
        return $value;
    }


    public function setShowOnMainAttribute($value)
    {
        $this->attributes['show_on_main'] = (bool)$value;
    }


    public function getShowOnMainAttribute(?bool $value): ?bool
    {
        return $value;
    }

}
