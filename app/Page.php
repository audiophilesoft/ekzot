<?php
declare(strict_types=1);

namespace App;



/**
 * App\Page
 *
 * @property-read mixed $created_at
 * @property mixed $is_active
 * @property-read mixed $updated_at
 * @mixin \Eloquent
 */
class Page extends Entry implements Commentable
{
    use CommentableTrait;

}
