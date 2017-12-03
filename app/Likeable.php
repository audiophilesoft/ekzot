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
interface Likeable
{
    public function likes();

    public function addLike(User $user);


}
