<?php
declare(strict_types=1);

namespace App;

/**
 * App\Entry
 *
 * @property-read mixed $created_at
 * @property mixed $is_active
 * @property-read mixed $updated_at
 * @mixin \Eloquent
 */
interface Commentable
{

    public function comments();

    public function addComment(array $data, User $user);


}
